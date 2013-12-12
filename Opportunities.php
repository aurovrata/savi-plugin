<?php
class Opportunity
{

   private $languages = array('English', 'French', 'Tamil');
   private $custom_type = 'av_opportunity';
   
   public function __construct()
    {
        // Create a hook to create custom Post Type 
        add_action( 'init', array($this, 'create_post_type' ));
        
        // Create a hook to create metabox for the custom post type
        add_action( 'add_meta_boxes', array($this, 'init_metabox' ));
        
       // Call the Units_Metabox when showing the post
        add_action( 'add_meta_boxes', array($this, 'init_admin_metabox'));        
        
        // Create a hook to save the custom post type
        add_action( 'save_post', array($this, 'save_opportunity_postdata' ),1,2);
 
        // Hook into the 'init' action
        add_action( 'init', array($this,'savi_opportunity_taxonomy'), 0 );


       // Hook into the 'init' action
       add_action( 'init', array($this,'savi_opportunity_categories'), 0 );
 
       // Add the scripts of the Listing plugin (taken from Explorable Themes)
       add_action( 'admin_enqueue_scripts', array($this,'enqueue_scripts_css') );
    }

    function enqueue_scripts_css() {
        $plugin_dir = plugins_url('', __FILE__ );
            
         wp_enqueue_style( 'style-name', $plugin_dir .'/css/bootstrap.css', array(), "1.00");        
         wp_enqueue_style( 'style-name-1', $plugin_dir .'/css/bootstrap-combobox.css', array(), "1.00");        
         // wp_enqueue_script( 'script-name-1', 'http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js', array('jquery'), '1.9.1', false );
         wp_enqueue_script( 'script-name-2', $plugin_dir .'/js/bootstrap.js', array('jquery'), '1.0.0', false );
         wp_enqueue_script( 'script-name-3', $plugin_dir .'/js/bootstrap-combobox.js', array('jquery'), '1.0.0', false );    
    }

    
    // Create a Custom Post Type
    public function create_post_type() {
        register_post_type( $this->custom_type,
            array(
                'labels' => array(
                    'name' => __( 'Opportunities' ),
                    'singular_name' => __( 'Opportunity' )
                ),
                'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments','revisions'  ),
                'public' => true,
                'has_archive' => true,
                'rewrite' => array('slug' => $this->custom_type),
            )
        );
    }
    

   // Register Custom Taxonomy
public function savi_opportunity_taxonomy()  {

	$labels = array(
		'name'                       => _x( 'Skills', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Skill', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Skills', 'text_domain' ),
		'all_items'                  => __( 'All skills', 'text_domain' ),
		'parent_item'                => __( 'Parent skill', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent skill:', 'text_domain' ),
		'new_item_name'              => __( 'New skill', 'text_domain' ),
		'add_new_item'               => __( 'Add new skill', 'text_domain' ),
		'edit_item'                  => __( 'Edit skill', 'text_domain' ),
		'update_item'                => __( 'Update skill', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate skills with commas', 'text_domain' ),
		'search_items'               => __( 'Search skills', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove skills', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used skills', 'text_domain' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	$labels_soft = array(
		'name'                       => _x( 'Softwares', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Software', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Softwares', 'text_domain' ),
		'all_items'                  => __( 'All softwares', 'text_domain' ),
		'parent_item'                => __( 'Parent software', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent software:', 'text_domain' ),
		'new_item_name'              => __( 'New software', 'text_domain' ),
		'add_new_item'               => __( 'Add new software', 'text_domain' ),
		'edit_item'                  => __( 'Edit software', 'text_domain' ),
		'update_item'                => __( 'Update software', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate softwares with commas', 'text_domain' ),
		'search_items'               => __( 'Search softwares', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove softwares', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used softwares', 'text_domain' ),
	);
	$args_soft = array(
		'labels'                     => $labels_soft,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
    $labels_languages = array(
		'name'                       => _x( 'Languages', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Language', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Languages', 'text_domain' ),
		'all_items'                  => __( 'All languages', 'text_domain' ),
		'parent_item'                => __( 'Parent language', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent language:', 'text_domain' ),
		'new_item_name'              => __( 'New language', 'text_domain' ),
		'add_new_item'               => __( 'Add new languages', 'text_domain' ),
		'edit_item'                  => __( 'Edit languages', 'text_domain' ),
		'update_item'                => __( 'Update languages', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate languages with commas', 'text_domain' ),
		'search_items'               => __( 'Search languages', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove languages', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used languages', 'text_domain' ),
	);
	$args_languages = array(
		'labels'                     => $labels_languages,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);

    $labels_prerequisites = array(
		'name'                       => _x( 'Prerequisites', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Prerequisite', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Prerequisites', 'text_domain' ),
		'all_items'                  => __( 'All prerequisite', 'text_domain' ),
		'parent_item'                => __( 'Parent prerequisite', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent prerequisite:', 'text_domain' ),
		'new_item_name'              => __( 'New prerequisite', 'text_domain' ),
		'add_new_item'               => __( 'Add new prerequisite', 'text_domain' ),
		'edit_item'                  => __( 'Edit prerequisite', 'text_domain' ),
		'update_item'                => __( 'Update prerequisite', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate prerequisites with commas', 'text_domain' ),
		'search_items'               => __( 'Search prerequisites', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove prerequisites', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used prerequisites', 'text_domain' ),
	);
	$args_prerequisites = array(
		'labels'                     => $labels_prerequisites,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'savi_opp_tag_skills', $this->custom_type, $args );
	register_taxonomy( 'savi_opp_tag_soft', $this->custom_type, $args_soft );
    register_taxonomy( 'savi_opp_tag_languages', $this->custom_type, $args_languages );
	register_taxonomy( 'savi_opp_tag_prerequisites', $this->custom_type, $args_prerequisites);
 
}


/*

// Register Custom Taxonomy

*/

function savi_opportunity_categories()  {

	$labels_units = array(
		'name'                       => _x( 'Work Type', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Work Type', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Work Type', 'text_domain' ),
		'all_items'                  => __( 'All Work Type', 'text_domain' ),
		'parent_item'                => __( 'Parent Work Type', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Work Type:', 'text_domain' ),
		'new_item_name'              => __( 'New Work Type', 'text_domain' ),
		'add_new_item'               => __( 'Add new work type', 'text_domain' ),
		'edit_item'                  => __( 'Edit work type', 'text_domain' ),
		'update_item'                => __( 'Update work type', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate Work Type with commas', 'text_domain' ),
		'search_items'               => __( 'Search Work Type', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove Work Type', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used Work Type', 'text_domain' ),
	);
	$args_units = array(
		'labels'                     => $labels_units,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
		register_taxonomy( 'savi_opp_cat_work_area', $this->custom_type, $args_units );
	

}


    // Create a new Metabox for the Custom Post Type
    public function init_metabox() {
        // Callback function hooked to opportunity_metabox function 
        add_meta_box( 'opportunities', "Opportunities", array($this,'opportunity_metabox'), $this->custom_type, 'advanced', 'high');
    }

   public function init_admin_metabox() {
   

    add_meta_box( 'opportunity_admin', "Admin", array($this,'admin_metabox'), $this->custom_type, 'normal', 'low');   
    }

    
   // include js and css for display the datepicker
   static function admin_enqueue_scripts()
		{
			$url = RWMB_CSS_URL . 'jqueryui';
			wp_register_style( 'jquery-ui-core', "{$url}/jquery.ui.core.css", array(), '1.8.17' );
			wp_register_style( 'jquery-ui-theme', "{$url}/jquery.ui.theme.css", array(), '1.8.17' );
			wp_enqueue_style( 'jquery-ui-datepicker', "{$url}/jquery.ui.datepicker.css", array( 'jquery-ui-core', 'jquery-ui-theme' ), '1.8.17' );

			// Load localized scripts
			$locale = str_replace( '_', '-', get_locale() );
			$file_path = 'jqueryui/datepicker-i18n/jquery.ui.datepicker-' . $locale . '.js';
			$deps = array( 'jquery-ui-datepicker' );
			if ( file_exists( RWMB_DIR . 'js/' . $file_path ) )
			{
				wp_register_script( 'jquery-ui-datepicker-i18n', RWMB_JS_URL . $file_path, $deps, '1.8.17', true );
				$deps[] = 'jquery-ui-datepicker-i18n';
			}

			wp_enqueue_script( 'rwmb-date', RWMB_JS_URL . 'date.js', $deps, RWMB_VER, true );
			wp_localize_script( 'rwmb-date', 'RWMB_Datepicker', array( 'lang' => $locale ) );
			
			// Required for the dynamic dropdown
			$plugin_dir = plugins_url('', __FILE__ );
          $dir =  get_bloginfo('url') . '/wp-content/plugins';   
            wp_enqueue_style( 'style-name', $plugin_dir .'/css/bootstrap.css', array(), "1.00");        
            wp_enqueue_style( 'style-name-1', $plugin_dir .'/css/bootstrap-combobox.css', array(), "1.00");
            wp_enqueue_style( 'style-name-3', $dir .'/meta-box/css/select.css', array(), "4.33");        
            wp_enqueue_style( 'style-name-4', $dir .'/meta-box/css/style.css', array(), "4.33");        
            wp_enqueue_script( 'script-name-2', $plugin_dir .'/js/bootstrap.js', array('jquery'), '1.0.0', false );
            wp_enqueue_script( 'script-name-3', $plugin_dir .'/js/bootstrap-combobox.js', array('jquery'), '1.0.0', false );    
		}
	
	 public function admin_metabox($post) {
     
        $post_id = $_GET['post'];//$wp_query->post->ID;
     
        $postmetaArray = get_post_meta($post->ID);
        if (sizeof($postmetaArray) > 0) {
            $revisions = $postmetaArray['comments'][0];  
        }
        else {
          $revisions = '';
        }
        echo "<div class='disp-row rwmb-textarea-wrapper'>";
            // Field Definition for Comments
                echo " <div class='rwmb-label'>";
                    echo "<label for='comments'>Revisions</label>\n";
                echo " </div>"; 
                echo "<div class='rwmb-input'>\n";
                    echo "<textarea rows='4' cols='50' name='comments' class='rwmb-textarea large-text'>$revisions</textarea>";
                echo "</div>";
            echo "</div>";

   }

    // Called when the custom posttype is saved
    public function save_opportunity_postdata( $post_id ) {
        global $post ;
        
        if( $post->post_type != $this->custom_type ) return $post_id;
        /*
        * We need to verify this came from the our screen and with proper authorization,
        * because save_post can be triggered at other times.
        */
        // Comment by Venkat - Removed the Nonce for the moment. Will do it later...

        // If this is an autosave, our form has not been submitted, so we don't want to do anything.
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            echo "Autosaved....";
            return $post_id;
        }

        // Check the user's permissions.
        if ( $this->custom_type == $_POST['post_type'] ) {

            if ( ! current_user_can( 'edit_page', $post_id ) )
                return $post_id;
        
        } else {

            if ( ! current_user_can( 'edit_post', $post_id ) )
                return $post_id;
        }

        /* OK, its safe for us to save the data now. */

        // Sanitize user input.
	

        //$opptun_title = sanitize_text_field( $_POST['opportunity_title'] );
        $av_units = sanitize_text_field( $_POST['av_unit'] );
        $unit_project = sanitize_text_field( $_POST['projectname'] );
        $contact_name = sanitize_text_field( $_POST['contactPerson'] );
        $contact_email = sanitize_text_field( $_POST['email'] );
        $contact_number = sanitize_text_field( $_POST['phone'] );
       
        $comments = sanitize_text_field( $_POST['comments'] );
        $startdate = sanitize_text_field( $_POST['startdate']);
        $enddate = sanitize_text_field( $_POST['enddate']);
        $duration = sanitize_text_field( $_POST['duration']);  
      
        $computer_required = sanitize_text_field( $_POST['computerrequired']);
        $timing = sanitize_text_field( $_POST['timing']);
        $morning_timings = sanitize_text_field( $_POST['morningtimings']);
        $afternoon_timings = sanitize_text_field( $_POST['afternoontimings']);
       
        update_post_meta( $post_id, 'av_unit', $av_units);
        update_post_meta( $post_id, 'projectname', $unit_project);
        update_post_meta( $post_id, 'contactPerson', $contact_name);
        update_post_meta( $post_id, 'email', $contact_email);
        update_post_meta( $post_id, 'phone', $contact_number);
       
        update_post_meta( $post_id, 'comments', $comments);
        update_post_meta( $post_id, 'startdate', $startdate);
        update_post_meta( $post_id, 'enddate', $enddate);
        update_post_meta( $post_id, 'duration', $duration);
       
        update_post_meta( $post_id, 'computerrequired', $computer_required);
        update_post_meta( $post_id, 'timing', $timing);
        update_post_meta( $post_id, 'morningtimings', $morning_timings);
        update_post_meta( $post_id, 'afternoontimings', $afternoon_timings);
          
    }   

    public function opportunity_metabox($post) {
        global  $wpdb;
        $postmetaArray = get_post_meta($post->ID);
        $projects = get_post_meta($post->ID, 'language', false);
        $allProjects = $projects[0];
        if (sizeof($postmetaArray) > 0) {

            $saved_AVUnit = $postmetaArray['av_unit'][0];
            $saved_projname = $postmetaArray['projectname'][0];
            $saved_contactPerson = $postmetaArray['contactPerson'][0];
            $saved_email = $postmetaArray['email'][0];
            $saved_phone = $postmetaArray['phone'][0];
            //$saved_language= unserialize($postmetaArray['language'][0]);
            $saved_comments = $postmetaArray['comments'][0];
            $saved_startdate = $postmetaArray['startdate'][0];
            $saved_enddate = $postmetaArray['enddate'][0];
            $saved_duration = $postmetaArray['duration'][0];  
            //$saved_otherlanguage  = $postmetaArray['otherlanguage'][0];
            $computer_required = $postmetaArray['computerrequired'][0];
            $timing = $postmetaArray['timing'][0];
            $morning_timings = $postmetaArray['morningtimings'][0];
            $afternoon_timings = $postmetaArray['afternoontimings'][0];  
           
                
        } else {

            $saved_AVUnit = '';
            $saved_projname = '';
            $saved_contactPerson = '';
            $saved_email = '';
            $saved_phone = '';
            //$saved_language= '';
            $saved_comments = '';
            $saved_startdate = '';
            $saved_enddate = '';
            $saved_duration = '';  
            //$saved_otherlanguage = '';
            $computer_required = '';
            $timing = '';
            $morning_timings = '';
            $afternoon_timings = '';
        }

        $AVUnitQuery = new WP_Query( array(
                    'post_type' => 'av_unit',
                    'posts_per_page' => -1,
                    'post_status' => array( 'publish' ),
                    ));
        $postIndex = 0;
        $projIndex = 0;

        // Start constructing the Select options for AV Units
        $unitSelectHTML = "<select class='combobox' name='av_unit' id='av_unit' onchange='unitChanged()' name='inline'> \n<option></option>\n";
        
        if ($AVUnitQuery->found_posts > 0) {
            while ($AVUnitQuery->have_posts()) {
                $AVUnitQuery->the_post();
                $unitname = get_the_title();
                $firstrow = true;
                $temp = str_replace(" ","",$unitname);
                // Construct the options for the select for AV Unit
                $unitSelectHTML .= "<option value='$temp'";
                
                // If the exisitng value of the AV Unit is equal to the current loop value then select the option
                if ($unitname == $saved_AVUnit)
                    $unitSelectHTML .= "selected";
                
                // End the Construct for the option
                $unitSelectHTML .= ">$unitname</option>\n";
            }
        }
        $unitSelectHTML .= "</Select>";
        echo "<!-- $unitSelectHTML -->";
        
        wp_reset_query();
        
        // Now we start on the Projects - The confusing mama ....
        $AVProjectQuery = new WP_Query( array(
                    'post_type' => 'av_project',
                    'posts_per_page' => -1,
                    'post_status' => array( 'publish' ),
                    ));
        
        
        // First we assemble the list of projects and the associated AV Units in an object Array
        if ($AVProjectQuery->found_posts > 0) {
            while ($AVProjectQuery->have_posts()) {
                $AVProjectQuery->the_post();
                $projname = get_the_title();
                $postID = get_the_ID();
                
                $parentUnitsMeta = get_post_meta($postID, 'parent_unit', false);
                $allParentUnits = $parentUnitsMeta[0];
                if (sizeof($allParentUnits) > 0) {
                    foreach($allParentUnits as $key=>$parentUnits) {
                        $unitProjectArray[] = new unitProject($parentUnits['parent_unit'], $projname);
                         
                         
                    }
                
                }
            }
          wp_reset_query();
        }
        
        // Get the Object Array sorted on UnitName
        //usort($unitProjectArray, 'psort');
        
        foreach ($unitProjectArray as $key => $row) {
          $unit[$key]  = $row->unit;
          $project[$key] = $row->project;
        }
        array_multisort($unit, SORT_ASC, $project, SORT_ASC, $unitProjectArray);
        
        echo "<script>console.log('";
        print_r($unitProjectArray);
        echo "Hello there";
        echo "');</script>";
        
        // Start Constructing the select options for all projects (to be used as the template when the user select any AV Unit
        $projhiddenSelectHTML = "<select style='display:none;' id='projectname_all'>\n";
        $projSelectHTML = "<select class='combobox' id='projname' name='inline'> \n<option></option>\n";
        $pr_avUnitName = "";
        $firstrow = false;
            
        for ($arrayIndex=0;$arrayIndex < sizeof($unitProjectArray);$arrayIndex++) {
            $avUnitName = $unitProjectArray[$arrayIndex]->unit;
            $projname = $unitProjectArray[$arrayIndex]->project;
            if ($avUnitName == $saved_AVUnit) {
                $projSelectHTML .= "<option value='$projname'";
                if ($projname == $saved_projname) {
                    $projSelectHTML .= "selected";
                }
                // End the construct of the option
                $projSelectHTML .= ">$tmpprojname</option>\n";
            }
          
                       
            if ($avUnitName != $pr_avUnitName) {
                if (!firstrow) {
                    $projhiddenSelectHTML .= "</optgroup>\n";
                }
               $temp = str_replace(" ","",$avUnitName);
                $projhiddenSelectHTML .= "<optgroup id='optgroup{$temp}'>";
                $pr_avUnitName = $avUnitName;    
            }
            
            $projhiddenSelectHTML .= "<option value='$projname'>$projname</option>\n";
        }
        
        $projhiddenSelectHTML .= "</select>";
        
        wp_reset_query();

        // Start constructing the select options for Projects (within a particular AV Unit)
        $projSelectHTML = "<select name='projectname' id='projectname'></select>\n";
        
        
        ?>
        <style>
        .disp-row {

        
        }
        
        input {
            height: auto !important;
        }
        .label {
            display: inline;
            width: 300px;
            color: black;
        
        }
        
        .input {
                display: inline-block;
        }
        
        </style>
        <?php 
     
            
        // Field definition for AV Units
        echo "<div class='disp-row'>";
          echo " <div class='rwmb-label'>"; 
             echo "<label for='av_unit'>Unit filter</label>";
           echo "</div>"; 
            echo "<div class='rwmb-input'>\n";
                echo $unitSelectHTML; // We have constructed this earlier
            echo "</div>";
        echo "</div>";

        // This is used for filtering the project name based on the AV Unit Selected
        echo $projhiddenSelectHTML;
            
        
        // Field Defintion for Project Name
        echo "<div class='disp-row'>";
          echo " <div class='rwmb-label'>";
            echo "<label for='project_name'>Project</label>\n";
          echo " </div>"; 
            echo "<div class='input'>\n";
                echo $projSelectHTML; // We have constructed this earlier
            echo "</div>";
        echo "</div>";
 
          // Field Definition for Contact Person
        echo "<div class='disp-row'>";
          echo " <div class='rwmb-label'>";
            echo "<label for='contactPerson'>Contact Person</label>\n";
          echo " </div>";  
            echo "<div class='input'>\n";
                echo "<input type='text' name='contactPerson' value='$saved_contactPerson' />\n";
            echo "</div>";
        echo "</div>";

        // Field Definition for Title
        echo "<div class='disp-row'>";
             echo " <div class='rwmb-label'>";           
                echo "<label for='email'>Contact Email</label>\n";
             echo " </div>";         
            echo "<div class='input'>\n";
                echo "<input type='text' name='email' value='$saved_email' />\n";
            echo "</div>";
        echo "</div>";
        
        // Field Definition for Phone
        echo "<div class='disp-row'>";
            echo " <div class='rwmb-label'>";   
                echo "<label for='phone'>Contact Phone</label>\n";
            echo " </div>";    
            echo "<div class='input'>\n";
                echo "<input type='text' name='phone' value='$saved_phone' />\n";
            echo "</div>";
        echo "</div>";
 
          // Field Defintion for start date
         echo "<div class='disp-row'>";
            echo " <div class='rwmb-label'>";        
                echo "<label for='startdate'>Start Date</label>\n";
            echo " </div>";         
            echo "<div class='input'>\n";
                echo'<input type="text" data-options="{&quot;dateFormat&quot;:&quot;yy-mm-dd&quot;,&quot;showButtonPanel&quot;:true,&quot;appendText&quot;:&quot;(yyyy-mm-dd)&quot;,&quot;changeMonth&quot;:true,&quot;changeYear&quot;:true}" size="30" id="dp1382523606529" value="'.$saved_startdate.'" name="startdate" class="rwmb-date hasDatepicker">';
            echo "</div>";
        echo "</div>";  
 
        // Field Defintion for end date
         echo "<div class='disp-row'>";
            echo " <div class='rwmb-label'>";
               echo "<label for='enddate'>End Date (optional)</label>\n";
            echo " </div>";              
            echo "<div class='input'>\n";
                echo'<input type="text" data-options="{&quot;dateFormat&quot;:&quot;yy-mm-dd&quot;,&quot;showButtonPanel&quot;:true,&quot;appendText&quot;:&quot;(yyyy-mm-dd)&quot;,&quot;changeMonth&quot;:true,&quot;changeYear&quot;:true}" size="30" id="dp1382523606529" value="'.$saved_enddate.'" name="enddate" class="rwmb-date hasDatepicker">';
            echo "</div>";
        echo "</div>";  
       
      // Field Definition for Duration
        echo "<div class='disp-row'>";
           echo " <div class='rwmb-label'>";
                echo "<label for='duration'>Duration</label>\n";
           echo " </div>";     
            echo "<div class='input'>\n";
                echo "<input type='number' name='duration' value='".$saved_duration."'/>(months)\n";
            echo "</div>";
        echo "</div>";
        
         
        
        echo "<div class='disp-row'>";
           echo " <div class='rwmb-label'>";
                echo "<label for='duration'>Computer Required</label>\n";
           echo " </div>";     
            echo "<div class='input'>\n";
           $cmreq_no=($computer_required == "NO")?"selected='selected'":"";
           $cmreq_yes=($computer_required == "YES")?"selected='selected'":""; 
           $tm_ft=($timing == "FT")?"selected='selected'":"";
           $tm_ht=($timing == "HT")?"selected='selected'":"";
         ?>
         
           <select size="0" id="computerrequired" name="computerrequired" class="rwmb-select">
             <option value="" <?php if($cmreq_no =="" && $cmreq_yes ==""): ?> selected="selected" <?php endif; ?> >Select a Computer Required</option>
             <option value="NO"  <?php echo $cmreq_no;?> >NO</option>
             <option value="YES" <?php echo $cmreq_yes;?>>YES</option>
           </select>         
         
         <?php       
            echo "</div>";
        echo "</div>";        
                
        echo "<div class='disp-row'>";
           echo " <div class='rwmb-label'>";
                echo "<label for='duration'>Timing</label>\n";
           echo " </div>";     
            echo "<div class='input'>\n";
         ?>
         
           <select size="0" id="timing" name="timing" class="rwmb-select">
             <option value="" <?php if($tm_ft =="" && $tm_ht ==""): ?>selected="selected" <?php endif; ?> >Select a Timing</option>
             <option value="FT" <?php echo $tm_ft;?>>FT</option>
             <option value="HT" <?php echo $tm_ht;?>>HT</option>
           </select>         
         
         <?php       
            echo "</div>";
        echo "</div>";
         
         echo "<div class='disp-row rwmb-textarea-wrapper'>";
            // Field Definition for Comments
                echo " <div class='rwmb-label'>";
                    echo "<label for='comments'>Morning Timings</label>\n";
                echo " </div>"; 
                echo "<div class='rwmb-input'>\n";
                    echo "<textarea rows='4' cols='50' name='morningtimings' class='rwmb-textarea large-text'>$morning_timings</textarea>";
                echo "</div>";
            echo "</div>";
            
             echo "<div class='disp-row rwmb-textarea-wrapper'>";
            // Field Definition for Comments
                echo " <div class='rwmb-label'>";
                    echo "<label for='afternoontimings'>Afternoon Timings</label>\n";
                echo " </div>"; 
                echo "<div class='rwmb-input'>\n";
                    echo "<textarea rows='4' cols='50' name='afternoontimings' class='rwmb-textarea large-text'>$afternoon_timings</textarea>";
                echo "</div>";
            echo "</div>"; 
        
                 
       
       
        // Field Definition for Language
/*             echo "<div class='disp-row'>";
            echo "<label for='language'>Language</label>\n";

       echo "<div class='input'>\n";
            $checked_value1 = "";
            $checked_value2 = "";
            $checked_value3 = "";         
            if (sizeof($language) > 0) {
                for($i=0;$i<=count($language);$i++) {   
                    if( $language[$i] == "value1" ){$checked_value1 = "checked ='checked'";}                 
                    if( $language[$i] == "value2" ){$checked_value2 = "checked ='checked'";} 
                    if( $language[$i] == "value3" ){$checked_value3 = "checked ='checked'";}  
                    
                }  
            }   
            echo "<label>";
            echo '<input type="checkbox" value="value1" name="language[]" class="rwmb-checkbox-list"'.$checked_value1.'> English';
            echo "</label><br>";
            echo "<label>";
            echo '<input type="checkbox" value="value2" name="language[]" class="rwmb-checkbox-list"'.$checked_value2.'> French';
            echo "</label><br>";
            echo "<label>";
            echo '<input type="checkbox" value="value3" name="language[]" class="rwmb-checkbox-list"'.$checked_value3.'> Tamil';
            echo "</label><br>";
            echo "<label>";

            echo '<input type="text" value="'.$otherlanguage.'" name="otherlanguage" class="rwmb-other-language"> Others';
            echo "</label>";  
            echo "</div>";
            echo "</div>";
 */           
        
           
        
        ?>
        
            <script>
            jQuery(document).ready(function(){
                jQuery('.combobox').combobox();
            });
        
            function unitChanged() {
                // this is called when AV Unit is changed. 
                $unitname = jQuery("#av_unit").val();

                // Remove the current set of options in the Project Select
                jQuery("#projectname options").remove();
                if ($unitname != '') {
                    // Get the options from the hidden project selects which pertains to the current AV Unit
                    $newselect = jQuery("#optgroup"+$unitname).html();
                } else {
                    $newselect = "<option value=''> </option>";
                }
                // Assign the new set of options pertaining to the current AV Unit
                jQuery("#projectname").html($newselect);

            }
            </script>
        <?php 
        
    }     

}

class unitProject {  
    public $unit = null;     
    public $project = null;     

    function __construct($unitName, $projectName){       
        $this->unit = $unitName;
        $this->project = $projectName;
    }
}
function psort($a,$b){
 if($a->unit == $b->unit) return 0;
 return ($a->project > $b->project ? 1 : -1);
}

?>
