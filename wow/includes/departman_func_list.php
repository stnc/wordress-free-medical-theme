<?php


Class CHfw_DepartmanProcess
{

    /**
     * Retrieve post categories only mp-event_category orginal get_the_category()
     * @param int $id
     * @return array
     * */
    public function CHfw_get_the_categoryMpEvent($id = false)
    {
        $categories = get_the_terms($id, 'mp-event_category');
        if (!$categories || is_wp_error($categories))
            $categories = array();

        $categories = array_values($categories);

        foreach (array_keys($categories) as $key) {
            _make_cat_compat($categories[$key]);
        }
        return apply_filters('get_the_categories', $categories, $id);
    }

    public function StaffProgramAndServices($id)
    {
        $var = esc_attr(get_post_meta($id, 'CHfw_DrAndDep_program_and_services', true));

        $vars = explode(',', $var);

        return $this->get_the_title_Custom($vars);
    }

    /*@uses  StaffProgramAndServices () */
    public function get_the_title_Custom($post = 0, $returnType = 'string')
    {

        $arrays_key = array();
        $i = 0;
        $args = array(
            'post_type' => 'mp-event',
            'post__in' => $post,
            'hide_empty' => 0,
            'posts_per_page' => -1,
            "post_status" => "publish",
        );
        $arrays_keyString = "";
        $wp_query_ = new WP_Query($args);

        if ($wp_query_->have_posts()) {
            while ($wp_query_->have_posts()) {
                $i++;
                $wp_query_->the_post();
                unset($previousday);
                if ($returnType == 'string') {
                    $arrays_keyString .= get_the_title() . ',';
                }
                $arrays_key[$i]["title"] = get_the_title();
            }
        }
        unset($wp_query_);
        if ($returnType == 'array') {
            return $arrays_key;
        } else {
            return substr($arrays_keyString, 0, -1);;
        }
    }


    /**
     * Staff All list
     * @return array
     * @uses
     * */
    public function StaffAll()
    {
        $arg = array(
            'offset' => 1,
            'post_type' => 'staff',
            'posts_per_page' => -1,
            'numberposts' => -1,
            "orderby" => "post_date",
            "order" => "DESC",
            "post_status" => "publish",
            'parent' => 1,
        );
        return get_posts($arg);
    }

    /**
     * mp event category list
     * @uses archive-mp-event.php , search-standart.php
     * @return array
     * */
    public function mpEventRootCategoryList_OnlyArg()
    {
        $root_categories = get_categories(
            array(
                'parent' => 0,
                'taxonomy' => 'mp-event_category',
                'post_type' => 'mp-event',
            )
        );
        $newResult = array();
        foreach ($root_categories as $key => $value) {
            $newResult[] = $value->slug;
        }

        $args = array(
            'post_type' => 'mp-event',
            'parent' => 0,
            'hide_empty' => 0,
            'posts_per_page' => -1,
            'orderby' => 'title',
            'order' => 'ASC',
            //'posts_per_page'         => '3',
            //'offset' => 3,
            'tax_query' => array(
                'relation' => 'OR',
                array(
                    'taxonomy' => 'mp-event_category',
                    'field' => 'slug',
                    'terms' => $newResult,
                    'include_children' => false,

                ),
            )
        );
        return $args;
    }


    /**
     * mp event category list
     * @uses  search-standart.php
     * @depency mpEventRootCategoryList_OnlyArg()
     * @return array
     * */
    public function mpEventRootCategoryList()
    {
        $i = 0;
        $wp_query_ = new WP_Query($this->mpEventRootCategoryList_OnlyArg());
        if ($wp_query_->have_posts()) {
            while ($wp_query_->have_posts()) {
                $i++;
                $wp_query_->the_post();
                unset($previousday);
                $imagewow = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'wow-masonry-BlogListSmall-Large');
                $arrays_key[$i]["id"] = get_the_ID();
                $arrays_key[$i]["title"] = get_the_title();
                $arrays_key[$i]["link"] = get_the_permalink();
                $arrays_key[$i]["image"] = $imagewow[0];
            }
        }
        return $arrays_key;
    }


    /**
     * Meta box relational list
     * program and services list find
     *
     * @param string $registerPostType ,
     * @param string $MetaboxName ,
     * @param string $list
     * @param boolean $is_departmanList doctor for relation departman
     * @return array
     * */
    public function CHfw_RelationMetaboxList($registerPostType, $MetaboxName, $list, $is_departmanList = false)
    {
        $MetaboxList = array();
        if ($list != "") {
            $ThisDepatman_RelationEventsArr = (explode(',', $list));
            foreach ($ThisDepatman_RelationEventsArr as $key => $row) {
                $myaarray[$key]['value'] = $row;
                $myaarray[$key]['key'] = $MetaboxName;
                $myaarray[$key]['compare'] = 'LIKE';
            }
            $myaarray['relation'] = 'or';

            $args = array(
                'post_type' => $registerPostType,
                'parent' => 0,
                'hide_empty' => 0,
                'posts_per_page' => -1,
                "post_status" => "publish",
                'meta_query' => $myaarray);

            $i = 0;

            $wp_query = new WP_Query($args);
            if ($wp_query->have_posts()) {
                while ($wp_query->have_posts()) {
                    $i++;
                    $wp_query->the_post();
                    unset($previousday);
                    $imagewow = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'wow-masonry-BlogListSmall-Large');
                    $MetaboxList[$i]["id"] = $wp_query->post->ID;
                    $MetaboxList[$i]["img"] = $imagewow[0];
                    $MetaboxList[$i]["title"] = $wp_query->post->post_title;
                    $MetaboxList[$i]["link"] = get_permalink($wp_query->post->ID) . '?ref=r';
                    if ($is_departmanList) {
                        $MetaboxList[$i]["departman"] = $this->StaffDepartmanName($wp_query->post->ID);
                        $MetaboxList[$i]["programAndServices"] = $this->StaffProgramAndServices($wp_query->post->ID);
                        $MetaboxList[$i]["staff_title"] = esc_attr(get_post_meta($wp_query->post->ID, 'CHfw-staffSetting_title', true));
                        $MetaboxList[$i]["excerpt"] = $this->excerpt_process($wp_query->post->post_content, $wp_query->post->post_excerpt);
                    }
                }
                wp_reset_postdata();
            }
            return $MetaboxList;
        }
    }

    public function StaffDepartmanName($id)
    {
        return esc_attr(get_post_meta($id, 'CHfw-staffSetting_expertise', true));
    }

    /**
     * Departman And Relation Category List
     *
     * @param array $categories
     * @param int $postId
     * @return array
     * */
    public function DepartmanAndRelationCategoriesListClass($categories, $postId)
    {
        $i = 0;
        $list_child_terms_args = array(
            'taxonomy' => 'mp-event_category',
            'use_desc_for_title' => 0, // best practice: don't use title attributes ever
            'child_of' => $categories
        );
        $newResult = get_categories($list_child_terms_args);

        $list = "";
        $SubDepartmansList = array();

        if (!$newResult == "") {
            $args = array(
                'post_type' => 'mp-event',
                'parent' => 0,
                'hide_empty' => 0,
                'posts_per_page' => -1,
                "post_status" => "publish",
                'post__not_in' => array($postId),//bu kendisni göstermez
                'tax_query' => array(
                    'relation' => 'OR',
                    array(
                        'taxonomy' => 'mp-event_category',
                        'field' => 'slug',
                        'terms' => $newResult[0]->slug,
                        'include_children' => true,
                    ),
                )
            );
            $wp_query_prog_services = new WP_Query($args);
            if ($wp_query_prog_services->have_posts()) {
                while ($wp_query_prog_services->have_posts()) {
                    $i++;
                    $wp_query_prog_services->the_post();
                    get_post_format();
                    unset($previousday);
                    $list .= $wp_query_prog_services->post->ID . ',';

                    $SubDepartmansList[$i]["title"] = $wp_query_prog_services->post->post_title;
                    $SubDepartmansList[$i]["excerpt"] = $this->excerpt_process($wp_query_prog_services->post->post_content, $wp_query_prog_services->post->post_excerpt);
                    $SubDepartmansList[$i]["link"] = get_permalink($wp_query_prog_services->post->ID);
                }
                wp_reset_postdata();
                return array(
                    'list' => $list,
                    'SubDepartmansList' => $SubDepartmansList,
                );
            }
        }

    }


    /**
     * Break word for more
     * @link http://bit.ly/2AI03av
     */
    public function break_text($text)
    {
        $length = 250;
        if (strlen($text) < $length + 10) return $text;//don't cut if too short

        $break_pos = strpos($text, ' ', $length);//find next space after desired length
        $visible = substr($text, 0, $break_pos);
        return balanceTags($visible) . " […]";
    }

    public function excerpt_process($content, $excerpt)
    {
        if ($excerpt != '') {
            $return_value = $excerpt;
        } else {
            $total = strlen($content);
            if ($total > 250) {
                $return_value = $this->break_text($content);
            } else {
                $return_value = $content;
            }
        }
        return $return_value;
    }

    /**
     * Programs and Services
     * @param int $ProvidersID with staff metabox provider id
     * @return array
     * @uses
     * */
    public function DepartmentSubCatInfo_forSubProvider($ProvidersID)
    {
        $arg = array(
            'p' => $ProvidersID,
            'offset' => 1,
            'post_type' => 'mp-event',
            'posts_per_page' => -1,
            'numberposts' => -1,
            "orderby" => "post_date",
            "order" => "DESC",
            "post_status" => "publish",
            'parent' => 0,
        );
        return get_posts($arg);
    }


    /**
     * Programs and Services array list
     * @param array $ProvidersID with staff metabox provider id
     * @return array
     * @uses
     * */
    public function DepartmentSubCatInfo_forSubProvider_ArrayList($ProvidersID)
    {
        $arg = array(
            'post__in' => $ProvidersID,
            'offset' => 1,
            'post_type' => 'mp-event',
            'posts_per_page' => -1,
            'numberposts' => -1,
            "orderby" => "post_date",
            "order" => "DESC",
            "post_status" => "publish",
            'parent' => 0,
        );
        return get_posts($arg);
    }

    /**
     * localtions array list (for selected list)
     * @param array $LocationsID
     * @return array
     * @uses single-staff.php
     * */
    public function Department_Location_ArrayList($LocationsIDs)
    {
        $arg = array(
            'post__in' => $LocationsIDs,
            'offset' => 1,
            'post_type' => 'locations',
            'posts_per_page' => -1,
            'numberposts' => -1,
            "orderby" => "post_date",
            "order" => "DESC",
            "post_status" => "publish",
            'parent' => 0,
        );
        return get_posts($arg);
    }


    /**
     * localtions array list (for selected list)
     * @param array $LocationsID
     * @return array
     * @uses single-staff.php
     * */
    public function Department_Info_forID($ID)
    {
        $arg = array(
            'p' => $ID,
            'offset' => 1,
            'post_type' => 'mp-event',
            'posts_per_page' => -1,
            'numberposts' => -1,
            "orderby" => "post_date",
            "order" => "DESC",
            "post_status" => "publish",
            'parent' => 0,
        );
        print_r($arg);
        return get_posts($arg);
    }

    /**
     * Departman & Events all list
     * mp-event post type all list
     * @return array
     * @uses
     * */
    public function DepartmansAll_List()
    {
        $arg = array(
            'offset' => 1,
            'post_type' => 'mp-event',
            'posts_per_page' => -1,
            'numberposts' => -1,
            "orderby" => "post_date",
            "order" => "DESC",
            "post_status" => "publish",
            'parent' => 1,
        );
        return get_posts($arg);
    }

    /**
     * Location and Hospital list * predefined operations
     * @param array $staffs with staff
     * @return array
     * */
    public function CHfw_hospitalListAlias($staffs)
    {
        foreach ($staffs as $staff) {
            $staffsListLocations[] = esc_attr(get_post_meta($staff["id"], 'CHfw_DrAndDep_display_locations', true));
        }

        $Hospitals = array_unique($staffsListLocations);

        return $this->CHfw_hospitalList($Hospitals);
    }

    /**
     * Location and Hospital list
     * @param array $Hospitals with staff id list
     * @return array
     * */
    public function CHfw_hospitalList($Hospitals, $is_departmanList = false)
    {
        $i = 0;
        $hospitalList = array();
        $args = array(
            'post_type' => 'locations',
            'parent' => 0,
            'hide_empty' => 0,
            'posts_per_page' => -1,
            'orderby' => 'title',
            'order' => 'DESC',
            "post_status" => "publish",
            'post__in' => $Hospitals,
        );
        $wp_query_prog_services = new WP_Query($args);
        if ($wp_query_prog_services->have_posts()) {
            while ($wp_query_prog_services->have_posts()) {
                $i++;
                $wp_query_prog_services->the_post();
                unset($previousday);
                $imagewow = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'wow-masonry-BlogListSmall-Large');
                $id = get_the_ID();
                $hospitalList[$i]["id"] = $id;
                $hospitalList[$i]["img"] = $imagewow[0];
                $hospitalList[$i]["title"] = get_the_title();
                $hospitalList[$i]["link"] = get_the_permalink();
                if ($is_departmanList) {
                    $adress = CHfw_get_meta($id, 'CHfw-staffLocation-adress', 'CHfw-StaffLocation-Setting');
                    $zipCode = CHfw_get_meta($id, 'CHfw-staffLocation-zipCode', 'CHfw-StaffLocation-Setting');
                    $email = CHfw_get_meta($id, 'CHfw-staffLocation-email', 'CHfw-StaffLocation-Setting');
                    $phone = CHfw_get_meta($id, 'CHfw-staffLocation-phone', 'CHfw-StaffLocation-Setting');
                    $hospitalList[$i]["adress"] = $adress;
                    $hospitalList[$i]["zipCode"] = $zipCode;
                    $hospitalList[$i]["phone"] = $phone;
                    $hospitalList[$i]["mail"] = $email;
                }

            }
            wp_reset_postdata();
            return $hospitalList;
        }
    }
}


class CHfw_Provider extends CHfw_DepartmanProcess
{

    private $PostId;
    private $MyDepartmanID;
    public $MyDepartmanInfo;
    public $myDepartmanLink;
    private $categories;
    public $ProvidersID;
    public $ListCategories;
    public $SubDepartmansList_ProgramsandServices;

    /**
     * init
     * @param int Post id
     * @return mix
     * */
    public function __construct($PostId)
    {
        $this->PostId = $PostId;
        $this->MyDepartmanID = esc_attr(get_post_meta($this->PostId, 'CHfw_DrAndDep_Select_Departman_Providers', true));
        $this->MyDepartmanInfo = get_term_by('id', $this->MyDepartmanID, 'mp-event_category');
        $this->myDepartmanLink = get_term_link($this->MyDepartmanInfo->slug, 'mp-event_category');
        $this->categories = esc_attr(get_post_meta($this->PostId, 'CHfw_DrAndDep_Select_Departman_Providers', true));
        $this->ProvidersID = esc_attr(get_post_meta($this->PostId, 'CHfw_DrAndDep_proAndServices_SubProviders', true));
        $this->DepartmanAndRelationCategoriesList();
    }

    /**
     * Department SubCat Info Sub Providers
     * @return array
     * @uses
     * */
    public function DepartmentSubCatInfo_forSubProviders()
    {
        return parent::DepartmentSubCatInfo_forSubProvider($this->ProvidersID);
    }

    /**
     * Departman And Relation Category List
     * @return void
     * */
    public function DepartmanAndRelationCategoriesList()
    {
        $DepartmanAndRelationCategoriesList = parent::DepartmanAndRelationCategoriesListClass($this->categories, $this->PostId);
        $ListCategories = $DepartmanAndRelationCategoriesList['list'] . $this->PostId;
        $SubDepartmansList = $DepartmanAndRelationCategoriesList['SubDepartmansList'];
        $this->ListCategories = $ListCategories;
        $this->SubDepartmansList_ProgramsandServices = $SubDepartmansList;
    }

    /**
     * hospital staff list
     * @return array
     * */
    public function staffs()
    {
        return parent::CHfw_RelationMetaboxList('staff', 'CHfw_DrAndDep_program_and_services', $this->ListCategories);
    }

    /**
     * hospital list
     * @return array
     * */
    public function locations()
    {
        return parent::CHfw_hospitalListAlias($this->staffs());
    }


}


class CHfw_ResourceFamily extends CHfw_DepartmanProcess
{

    private $PostId;
    private $MyDepartmanID;
    public $MyDepartmanInfo;
    public $myDepartmanLink;
    private $categories;
    public $ProvidersID;
    public $ListCategories;
    public $SubDepartmansList_ProgramsandServices;

    /**
     * init
     * @param int Post id
     * @return mix
     * */
    public function __construct($PostId)
    {
        $this->PostId = $PostId;
        $this->MyDepartmanID = esc_attr(get_post_meta($this->PostId, 'CHfw_DrAndDep_Select_Departman_ResourceFamily', true));
        $this->MyDepartmanInfo = get_term_by('id', $this->MyDepartmanID, 'mp-event_category');
        $this->myDepartmanLink = get_term_link($this->MyDepartmanInfo->slug, 'mp-event_category');
        $this->categories = esc_attr(get_post_meta($this->PostId, 'CHfw_DrAndDep_Select_Departman_ResourceFamily', true));
        $this->ProvidersID = esc_attr(get_post_meta($this->PostId, 'CHfw_DrAndDep_proAndServices_SubResourceFamilys', true));
        $this->DepartmanAndRelationCategoriesList();
    }

    /**
     * Department SubCat Info Sub Providers
     * @return array
     * @uses
     * */
    public function DepartmentSubCatInfo_forSubProviders()
    {
        return parent::DepartmentSubCatInfo_forSubProvider($this->ProvidersID);
    }

    /**
     * Departman And Relation Category List
     * @return void
     * */
    public function DepartmanAndRelationCategoriesList()
    {
        $DepartmanAndRelationCategoriesList = parent::DepartmanAndRelationCategoriesListClass($this->categories, $this->PostId);
        $ListCategories = $DepartmanAndRelationCategoriesList['list'] . $this->PostId;
        $SubDepartmansList = $DepartmanAndRelationCategoriesList['SubDepartmansList'];
        $this->ListCategories = $ListCategories;
        $this->SubDepartmansList_ProgramsandServices = $SubDepartmansList;
    }

    /**
     * hospital staff list
     * @return array
     * */
    public function staffs()
    {
        return parent::CHfw_RelationMetaboxList('staff', 'CHfw_DrAndDep_program_and_services', $this->ListCategories);
    }

    /**
     * hospital list
     * @return array
     * */
    public function locations()
    {
        return parent::CHfw_hospitalListAlias($this->staffs());
    }

    /**
     * Providers list
     * @return array
     * */
    public function ResourceFamily()
    {
        return parent::CHfw_RelationMetaboxList('resource_family', 'CHfw_DrAndDep_proAndServices_SubResourceFamilys', $this->ListCategories);
    }

}

class CHfw_Treatments extends CHfw_DepartmanProcess
{

    private $PostId;
    private $MyDepartmanID;
    public $MyDepartmanInfo;
    public $myDepartmanLink;
    private $categories;
    public $ProvidersID;
    public $ListCategories;
    public $SubDepartmansList;

    /**
     * init
     * @param int Post id
     * @return mix
     * */
    function __construct($PostId)
    {
        $this->PostId = $PostId;
        $this->MyDepartmanID = esc_attr(get_post_meta($this->PostId, 'CHfw_DrAndDep_Select_Departman_Treatment', true));
        $this->MyDepartmanInfo = get_term_by('id', $this->MyDepartmanID, 'mp-event_category');
        $this->myDepartmanLink = get_term_link($this->MyDepartmanInfo->slug, 'mp-event_category');
        $this->categories = esc_attr(get_post_meta($this->PostId, 'CHfw_DrAndDep_Select_Departman_Treatment', true));
        $this->ProvidersID = esc_attr(get_post_meta($this->PostId, 'CHfw_DrAndDep_proAndServices_SubTreatments', true));
        $this->DepartmanAndRelationCategoriesList();
    }

    /**
     * Department SubCat Info Sub Providers
     * @return array
     * @uses
     * */
    function DepartmentSubCatInfo_forSubProviders()
    {
        return parent::DepartmentSubCatInfo_forSubProvider($this->ProvidersID);
    }

    /**
     * Departman And Relation Category List
     * @return void
     * */
    function DepartmanAndRelationCategoriesList()
    {
        $DepartmanAndRelationCategoriesList = parent::DepartmanAndRelationCategoriesListClass($this->categories, $this->PostId);
        $ListCategories = $DepartmanAndRelationCategoriesList['list'] . $this->PostId;
        $SubDepartmansList = $DepartmanAndRelationCategoriesList['SubDepartmansList'];
        $this->ListCategories = $ListCategories;
        $this->SubDepartmansList = $SubDepartmansList;
    }

    /**
     * hospital staff list
     * @return array
     * */
    function staffs()
    {
        return parent::CHfw_RelationMetaboxList('staff', 'CHfw_DrAndDep_program_and_services', $this->ListCategories);
    }

    /**
     * hospital list
     * @return array
     * */
    function locations()
    {
        return parent::CHfw_hospitalListAlias($this->staffs());
    }

    /**
     * Providers list
     * @return array
     * */
    function treatments()
    {
        return parent::CHfw_RelationMetaboxList('resource_family', 'CHfw_DrAndDep_proAndServices_SubTreatments', $this->ListCategories);
    }

}

class CHfw_Conditions extends CHfw_DepartmanProcess
{

    private $PostId;
    private $MyDepartmanID;
    public $MyDepartmanInfo;
    public $myDepartmanLink;
    private $categories;
    public $ProvidersID;
    public $ListCategories;
    public $SubDepartmansList;

    /**
     * init
     * @param int Post id
     * @return mix
     * */
    public function __construct($PostId)
    {
        $this->PostId = $PostId;
        $this->MyDepartmanID = esc_attr(get_post_meta($this->PostId, 'CHfw_DrAndDep_Select_Departman_Condition', true));
        $this->MyDepartmanInfo = get_term_by('id', $this->MyDepartmanID, 'mp-event_category');
        $this->myDepartmanLink = get_term_link($this->MyDepartmanInfo->slug, 'mp-event_category');
        $this->categories = esc_attr(get_post_meta($this->PostId, 'CHfw_DrAndDep_Select_Departman_Condition', true));
        $this->ProvidersID = esc_attr(get_post_meta($this->PostId, 'CHfw_DrAndDep_proAndServices_SubCondition', true));
        $this->DepartmanAndRelationCategoriesList();
    }

    /**
     * Department SubCat Info Sub Providers
     * @return array
     * @uses
     * */
    public function DepartmentSubCatInfo_forSubProviders()
    {
        return parent::DepartmentSubCatInfo_forSubProvider($this->ProvidersID);
    }

    /**
     * Departman And Relation Category List
     * @return void
     * */
    public function DepartmanAndRelationCategoriesList()
    {
        $DepartmanAndRelationCategoriesList = parent::DepartmanAndRelationCategoriesListClass($this->categories, $this->PostId);
        $ListCategories = $DepartmanAndRelationCategoriesList['list'] . $this->PostId;
        $SubDepartmansList = $DepartmanAndRelationCategoriesList['SubDepartmansList'];
        $this->ListCategories = $ListCategories;
        $this->SubDepartmansList = $SubDepartmansList;
    }

    /**
     * hospital staff list
     * @return array
     * */
    public function staffs()
    {
        return parent::CHfw_RelationMetaboxList('staff', 'CHfw_DrAndDep_program_and_services', $this->ListCategories);
    }

    /**
     * hospital list
     * @return array
     * */
    public function locations()
    {
        return parent::CHfw_hospitalListAlias($this->staffs());
    }

    /**
     * Providers list
     * @return array
     * */
    public function treatments()
    {
        return parent::CHfw_RelationMetaboxList('resource_family', 'CHfw_DrAndDep_proAndServices_SubTreatments', $this->ListCategories);
    }

}

class CHfw_Mp_event_Page extends CHfw_DepartmanProcess
{

    private $PostId;

    private $categories;
    public $ListCategories;
    public $SubDepartmansList_ProgramsandServices;

    /**
     * init
     * @param int Post id
     * @return mix
     * */
    public function __construct($PostId)
    {
        $this->PostId = $PostId;
        $this->categories = parent::CHfw_get_the_categoryMpEvent($PostId);
        $this->DepartmanAndRelationCategoriesList();
    }


    /**
     * Departman And Relation Category List
     * @return void
     * */
    public function DepartmanAndRelationCategoriesList()
    {
        $this_my_category_name = parent::CHfw_get_the_categoryMpEvent($this->PostId);
        $DepartmanAndRelationCategoriesList = parent::DepartmanAndRelationCategoriesListClass($this_my_category_name[0]->term_id, $this->PostId);
        $ListCategories = $DepartmanAndRelationCategoriesList['list'] . $this->PostId;
        $SubDepartmansList = $DepartmanAndRelationCategoriesList['SubDepartmansList'];
        $this->ListCategories = $ListCategories;
        $this->SubDepartmansList_ProgramsandServices = $SubDepartmansList;
    }

    /**
     * hospital staff list
     * @return array
     * */
    public function staffs($is_departmanList = false)
    {
        return parent::CHfw_RelationMetaboxList('staff', 'CHfw_DrAndDep_program_and_services', $this->ListCategories, $is_departmanList);
    }


    /**
     * Providers list
     * @return array
     * */
    public function treatments($is_departmanList = false)
    {
        return parent::CHfw_RelationMetaboxList('treatments', 'CHfw_DrAndDep_proAndServices_SubTreatments', $this->ListCategories, $is_departmanList);
    }

    /**
     * conditions list
     * @return array
     * */
    public function conditions($is_departmanList = false)
    {
        return parent::CHfw_RelationMetaboxList('conditions', 'CHfw_DrAndDep_proAndServices_SubConditions', $this->ListCategories, $is_departmanList);
    }

    /**
     * Providers list
     * @return array
     * */
    public function providers($is_departmanList = false)
    {
        return parent::CHfw_RelationMetaboxList('providers', 'CHfw_DrAndDep_proAndServices_SubProviders', $this->ListCategories, $is_departmanList);
    }

    /**
     * resource_family list
     * @return array
     * */
    public function resource_family($is_departmanList = false)
    {
        return parent::CHfw_RelationMetaboxList('resource_family', 'CHfw_DrAndDep_proAndServices_SubResourceFamilys', $this->ListCategories, $is_departmanList);
    }

    /**
     * resource_family list
     * @return array
     * */
    public function locations($is_departmanList = false)
    {
        $staffsListLocations = array();
        $staffs = $this->staffs();
        foreach ($staffs as $staff) {
            $staffsListLocations[] = esc_attr(get_post_meta($staff["id"], 'CHfw_DrAndDep_display_locations', true));
        }

        $Hospitals = array_unique($staffsListLocations);

        return $this->CHfw_hospitalList($Hospitals, $is_departmanList);
    }

}

class CHfw_Locations extends CHfw_DepartmanProcess
{

    private $PostId;
    private $MyDepartmanID;
    public $MyDepartmanInfo;
    public $myDepartmanLink;
    private $categories;
    public $ProvidersID;
    public $ListCategories;
    public $SubDepartmansList;

    /**
     * init
     * @param int Post id
     * @return mix
     * */
    public function __construct($PostId)
    {
        $this->PostId = $PostId;

    }

    /**
     * Department SubCat Info Sub Providers
     * @return array
     * @uses
     * */
    public function DepartmentSubCatInfo_forSubProviders()
    {
        //$list = $this->StaffRelationAllIds();
        //$list =$this->PostId;
        //return parent::CHfw_RelationMetaboxList('staff', 'CHfw_DrAndDep_display_locations', $list);

        /*$staff_id = $this->StaffRelationAllIds();
        return $staff_id;*/
    }


    /**
     * Department SubCat Info Sub Providers
     * @return array
     * @uses
     * */
    public function StaffRelationAllIds()
    {
        $staff_id = array();
        $staff_list = parent::StaffAll();
        foreach ($staff_list as $key => $staff) {
            $staff_id[$key] = $staff->ID;
        }
        return $staff_id;
    }


    /**
     * hospital staff list
     * @return array
     * */
    public function Program_and_services()
    {
        $staffsListLocations = array();
        foreach ($this->staffs() as $key => $staff) {
            $staffsListLocations[] = esc_attr(get_post_meta($staff["id"], 'CHfw_DrAndDep_program_and_services', true));
        }
        $program_and_servicesIdList = array_unique($staffsListLocations);
        return parent::DepartmentSubCatInfo_forSubProvider_ArrayList($program_and_servicesIdList);
    }


    /**
     * hospital staff list
     * @return array
     * */
    public function staffs()
    {

        //$list = $this->StaffRelationAllIds();
        $list = $this->PostId;
        return parent::CHfw_RelationMetaboxList('staff', 'CHfw_DrAndDep_display_locations', $list);

        /*$staff_id = $this->StaffRelationAllIds();
        return $staff_id;*/

    }


}

Class CHfw_SearchProcess
{
    /**
     * language list
     * @return array
     * */
    public function langugeList()
    {

        return get_categories(
            array(
                'parent' => 0,
                'taxonomy' => 'staff_languages',
                'post_type' => 'staff',
                'orderby' => 'title',
                'order' => 'DESC',
            )
        );
    }


    /**
     * Location and Hospital list
     * @return array
     * */
    public function CHfw_hospitalList()
    {
        $i = 0;
        $hospitalList = array();
        $args = array(
            'post_type' => 'locations',
            'parent' => 0,
            'hide_empty' => 0,
            'posts_per_page' => -1,
            "post_status" => "publish",
            'orderby' => 'title',
            'order' => 'DESC',
        );
        $wp_query_prog_services = new WP_Query($args);
        if ($wp_query_prog_services->have_posts()) {
            while ($wp_query_prog_services->have_posts()) {
                $i++;
                $wp_query_prog_services->the_post();
                unset($previousday);
                $hospitalList[$i]["id"] = get_the_ID();
                $hospitalList[$i]["title"] = get_the_title();
                $hospitalList[$i]["link"] = get_the_permalink() . '?ref=r';
            }
            wp_reset_postdata();
            return $hospitalList;
        }
    }

    /**
     * Departman root list
     * @return array
     * */
    public function DepartmanRootList()
    {
        return get_categories(
            array(
                'parent' => 0,
                'taxonomy' => 'mp-event_category',
                'post_type' => 'mp-event',
            )
        );
    }

    /**
     * Departman And Relation Category List
     *
     * @param array $categories
     * @param int $postId
     * @return array
     * */
    public function DepartmanAndRelationCategoriesListAll()
    {
        $only_root = false;

        $i = 0;
        if ($only_root) {
            $list_child_terms_args = array(
                'parent' => 0,
                'taxonomy' => 'mp-event_category',
                'post_type' => 'mp-event',
            );

        } else {
            $list_child_terms_args = array(

                'taxonomy' => 'mp-event_category',
                'post_type' => 'mp-event',
            );

        }

        $newResult = array();
        $newResult2 = get_categories($list_child_terms_args);

        foreach ($newResult2 as $newRes) {
            $newResult[] = $newRes->slug;
        }


        if (!$newResult == "") {
            $args = array(
                'post_type' => 'mp-event',
                'child_of' => 1,
                'parent' => 1,
                'hide_empty' => 0,
                'posts_per_page' => -1,
                'orderby' => 'title',
                'order' => 'DESC',
                "post_status" => "publish",
                'tax_query' => array(
                    'relation' => 'OR',
                    array(
                        'taxonomy' => 'mp-event_category',
                        'field' => 'slug',
                        'terms' => $newResult,
                        'include_children' => false,
                    ),
                )
            );
            $wp_query_prog_services = new WP_Query($args);

            if ($wp_query_prog_services->have_posts()) {
                while ($wp_query_prog_services->have_posts()) {
                    $wp_query_prog_services->the_post();
                    get_post_format();
                    unset($previousday);

                    $i++;
                    $SubDepartmansList[$i]['title'] = get_the_title();
                    $SubDepartmansList[$i]['id'] = get_the_ID();
                    $SubDepartmansList[$i]['slug'] = $wp_query_prog_services->post->post_name;
                    $SubDepartmansList[$i]['catID'] = $this->DepartmanAndRelationCategoriesListAll_cat_find($wp_query_prog_services->post->ID);
                }
                wp_reset_postdata();
                return $SubDepartmansList;
            }
        }
    }

    public function DepartmanAndRelationCategoriesListAll_cat_find($id)
    {
        $d = $this->CHfw_get_the_categoryMpEvent($id);
        //print_r($d);
        return ($d[0]->category_parent);
    }

    /**
     * Retrieve post categories only mp-event_category orginal get_the_category()
     * @param int $id
     * @return array
     * */
    public function CHfw_get_the_categoryMpEvent($id = false)
    {
        $categories = get_the_terms($id, 'mp-event_category');
        if (!$categories || is_wp_error($categories))
            $categories = array();

        $categories = array_values($categories);

        foreach (array_keys($categories) as $key) {
            _make_cat_compat($categories[$key]);
        }
        return apply_filters('get_the_categories', $categories, $id);
    }

}

/**
 * Staff find ajax request
 *Search page
 */
function CHfw_StaffFindAjax()
{
    if (isset($_REQUEST)) {
        global $wpdb;
        $query = $_REQUEST['query'];

        $mypostids = $wpdb->get_col("select ID from $wpdb->posts where post_title like '%$query%' ");

        $args = array(
            'post_type' => 'staff',
            'post__in' => $mypostids,
        );
        $myposts_display_doctor_department = get_posts($args);
        foreach ($myposts_display_doctor_department as $key => $rows) {
            $data['suggestions'][$key]['value'] = $rows->post_title;
            $data['suggestions'][$key]['data'] = get_permalink($rows->ID);
        }

        die(json_encode($data));

    }

}

add_action('wp_ajax_CHfw_StaffFindAjax', 'CHfw_StaffFindAjax');
// If you wanted to also use the function for non-logged in users (in a theme for example)
add_action('wp_ajax_nopriv_CHfw_StaffFindAjax', 'CHfw_StaffFindAjax');

/**
 * Staff find ajax request
 *Search page
 */
function CHfw_StaffProgramAndServices_FindAjax()
{
    // The $_REQUEST contains all the data sent via ajax
    if (isset($_REQUEST)) {

        $_REQUEST = array_map( 'stripslashes_deep', $_REQUEST );
        $value = $_REQUEST['value'];

        $list_child_terms_args = array(
            'taxonomy' => 'mp-event_category',
            'use_desc_for_title' => 0, // best practice: don't use title attributes ever
            'child_of' => $value // show only child terms of the current page's
        );
        $root_categories = get_categories($list_child_terms_args);
        //	print_r ($root_categories);
        $mp_events = array(
            'offset' => 1,
            'post_type' => 'mp-event',
            'posts_per_page' => -1,
            'numberposts' => -1,
            "orderby" => "post_date",
            "order" => "DESC",
            "post_status" => "publish",
            'parent' => 0,
            'tax_query' => array(
                'relation' => 'OR',
                array(
                    'taxonomy' => 'mp-event_category',
                    'field' => 'term_id',
                    'terms' => $root_categories[0]->term_id,
                    'include_children' => true,
                ),
            )
        );
        $myposts_display_doctor_department = get_posts($mp_events);
        ?>
        <?php foreach ($myposts_display_doctor_department as $mypost) { ?>
            <option value="<?php echo $mypost->ID ?>"><?php echo $mypost->post_title ?></option>
        <?php } ?>
        <?php
    }
    // Always die in functions echoing ajax content
    die();

}

add_action('wp_ajax_CHfw_StaffProgramAndServices_FindAjax', 'CHfw_StaffProgramAndServices_FindAjax');
// If you wanted to also use the function for non-logged in users (in a theme for example)
add_action('wp_ajax_nopriv_CHfw_StaffProgramAndServices_FindAjax', 'CHfw_StaffProgramAndServices_FindAjax');