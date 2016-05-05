<?php

/**
 * Created by PhpStorm.
 * User: edirect
 * Date: 17/11/2015
 * Time: 10:05
 */
class EdOffre
{
    private static $_instance_offre = null;
    public $file;
    public $dir;
    public $assets_dir;
    public $assets_url;

    public function __construct($file = '')
    {
        $this->file = $file;
        $this->dir = dirname($this->file);
        $this->assets_dir = trailingslashit($this->dir) . 'assets';
        $this->assets_url = esc_url(trailingslashit(plugins_url('/assets/', $this->file)));
        add_shortcode('edirect-offre', array($this, 'shortcode'));
        add_action('wp_enqueue_scripts', array($this, 'styles_scripts'));
        add_action('wp_ajax_edoffre_submit', array($this, 'edoffre_submit'));
        add_action('wp_ajax_nopriv_edoffre_submit', array($this, 'edoffre_submit'));
        add_action('admin_menu', array($this, 'edoffre_admin') );
        add_action('wp_ajax_edoffre_liste_demandeurs', array($this, 'edoffre_liste_demandeurs'));
        add_action('wp_ajax_nopriv_edoffre_liste_demandeurs', array($this, 'edoffre_liste_demandeurs'));
    }

    /**
     * EdTools Instance
     */
    public static function instance($file = '')
    {
        if (is_null(self::$_instance_offre)) {
            self::$_instance_offre = new self($file);
        }
        return self::$_instance_offre;
    }

    /**
     * Shortcode extract html
     */
     public function shortcode($attributes, $content = null)
    {

        $html = '';

        extract(shortcode_atts(array(
            'titre' => "Offre titre",
            'type' =>  "vitrine",
            'button' => ""
        ), $attributes));

        $html .= '<div class="clearfix">
<!-- Devices -->
<div class="devices">
<div class="tablet">
<div class="mask">
<ul class="screens">
<li class="active in" id="ts01"><img src="http://localhost/edirect_site/wp-content/uploads/2015/11/Pack.png" alt="Screen 01"></li>
<li id="ts02"><img src="http://localhost/edirect_site/wp-content/uploads/2015/11/Pack2.png" alt="Screen 02"></li>
<li id="ts03"><img src="http://localhost/edirect_site/wp-content/uploads/2015/11/Pack2.png" alt="Screen 03"></li>
<li id="ts04"><img src="http://localhost/edirect_site/wp-content/uploads/2015/11/3.png" alt="Screen 04"></li>
</ul>
</div>
</div>
</div>
<!-- Tabs -->
<div class="tabs light-color text-center">
<div class="block-heading hidden-when-stack">
<h2>Nos Offres</h2>
</div>

<ul class="nav-tabs" data-autoswitch="true" data-interval="5000">
<li class="active"><a href="#video-player" data-toggle="tab" data-tablet="#ts01" data-phone="#ps01">Vitrine</a></li>
<li><a href="#settings" data-toggle="tab" data-tablet="#ts02" data-phone="#ps02">E-commerce</a></li>
<li><a href="#file-sharing" data-toggle="tab" data-tablet="#ts03" data-phone="#ps03">Applications métiers spécifiques</a></li>
<li><a href="#chat" data-toggle="tab" data-tablet="#ts04" data-phone="#ps04">Site de marque / produit</a></li>
</ul>

<div class="tab-content">
<div class="tab-pane transition scale fade in active" id="video-player">
<h3>Votre entreprise est unique, vos produits sont uniques, votre site web doit l\'etre aussi !</h3>
<p>Un site web vitrine est un outil de communication efficace et indispensable. Il refléte l\'image de votre entreprise, permet de présenter votre activité, vos produits et services.
Gràce à notre expertise et avec une équipe de développeurs professionnels, nous nous engageons à vous créer un site web vitrine à votre image, adapté à votre secteur d\'activité avec un design attractif et un esthétisme homogéne.
</p>';
        $html .='
<div style="text-align: center;"><button class="button button--wayra button--border-thick button--text-upper button--size-s" data-toggle="modal" data-target="#offreModal" data-whatever="offre:vitrine" data-imagebg="http://localhost/edirect_site/wp-content/uploads/2015/11/Pack.png">Cette offre m\'intéresse</button></div>
</div>
<div class="tab-pane transition scale fade" id="settings">
<p>Pourquoi opter pour un site e-commerce ?
Un site web e-commerce est la solution idéale pour chaque entreprise qui souhaite vendre ses produits et services sur Internet. Il offre une multitude d\'options :</p>
<ol>
<li>Disposer d\'une boutique en ligne ouverte 24 h/24, 7 j/7</li>
<li>Accroitre sa visibilité internationale</li>
<li>Acquérir de nouveaux clients</li>
<li>Générer plus du trafic dans ses enseignes physiques</li>
<li>Améliorer sa e-notoriété</li>
</ol>
<p>
Si vous souhaitez doter votre entreprise d\'un site e-commerce, eDirect vous fournit la solution la plus adaptée à vos besoins: un site personnalisé, distingué, totalement administrable et simple d\'utilisation.
</p>
<div style="text-align: center;"><button class="button button--wayra button--border-thick button--text-upper button--size-s" data-toggle="modal" data-target="#offreModal" data-whatever="offre:e-commerce" data-imagebg="http://localhost/edirect_site/wp-content/uploads/2015/11/Pack2.png">Cette offre m\'intéresse</button></div>
</div>
<div class="tab-pane transition scale fade" id="file-sharing">
<p>Vous souhaitez organiser au mieux votre activité ? Vous souhaitez créer une application qui couvre les différentes fonctions de votre entreprise ?
Nous pouvons vous développer une solution spécifique adaptée à votre activité et à votre structure.
Parmi nos solutions réalisées:</p>
<ol>
<li>Gestion de calendrier </li>
<li>Gestion dématérialisée de processus de création de nouveaux produits</li>
<li>Gestion des prises de rendez-vous !</li>
</ol>
</div>
<div class="tab-pane transition scale fade" id="chat">
<p>Les sites web de marques sont spécialement destinés aux amateurs ou à fansé d\'une marque.

Ces sites doivent étre conviviaux et interactifs. Ils peuvent proposer des activités amusantes telles que les jeux de concours, quizz et conseils pour faire interagir leurs visiteurs d\'une part, et collecter, d\'une autre part, le maximum d\'information en vue d\'enrichir leur base de données.
</p>
</div>
</div>
</div>
</div>';

        return $html;
    }

    public function styles_scripts()
    {
        wp_enqueue_style('edoffre_css', esc_url($this->assets_url) . 'css/edoffre.css', '', '');
        wp_register_script('validation', esc_url($this->assets_url) . 'js/jquery.validate.min.js', array(), '');
        wp_enqueue_script('validation');
        wp_register_script('edoffre_js', esc_url($this->assets_url) . 'js/edoffre.js', array(), '');
        wp_enqueue_script('edoffre_js');
    }

    public function edoffre_submit()
    {
        global $wpdb;
        $offre_table = $wpdb->prefix . "edirect_offres";
        $data = array();
        $result = $wpdb->insert($offre_table, array(
            'nom' => $_POST['nom'],
            'nom_entreprise' => $_POST['nom_entreprise'],
            'tel' => $_POST['tel_entreprise'],
            'mobile' => $_POST['fax_entreprise'],
            'email' => $_POST['email_offre'],
            'offre' => $_POST['type_offre'],
            'message' => $_POST['message_offre']
        ));

        if($result)
        {
            $data['success'] = true;
        }
        else
        {
            $data['success'] = false;
        }

        echo json_encode($data);die();
    }

    public function edoffre_dashboard()
    {

        require_once('dashboard.php');

    }

    public function edoffre_admin()
    {
        global $wp_version;
        $icon_url = $wp_version >= 3.8 ? 'dashicons-list-view' : '';
        add_menu_page( 'eDirect Offre', 'eDirect Offre', 'manage_options', 'edoffre_dashboard', array($this,'edoffre_dashboard'), $icon_url, '6' );
        add_action( 'admin_enqueue_scripts', array($this,'edoffre_admin_assets') );
        //  add_action( 'wp_ajax_edaudit_liste_demandeurs', array($this,'edaudit_liste_demandeurs') );

    }

    public function edoffre_admin_assets()
    {
        wp_enqueue_style('ed-dashboard-offre-css',  esc_url($this->assets_url) . 'css/dashboard.css',array(), '');
        wp_enqueue_style('flat-ui', esc_url($this->assets_url) . 'css/flat-ui.min.css', '', '');
        wp_enqueue_script('ed-admin-js-offre',  esc_url($this->assets_url) . 'js/admin.js',array(), '');
        wp_localize_script( 'ed-admin-js-offre', 'ED_A',
            array(
                'ajaxurl' => admin_url( 'admin-ajax.php' ),
                'baseurl' => get_site_url()
            )
        );
    }

    public function edoffre_liste_demandeurs()
    {
        global $wpdb;
        $offre_table = $wpdb->prefix . "edirect_offres";
        $page = isset($_POST['page']) && ctype_digit($_POST['page']) ? $_POST['page']-1 : 0;
        $per_page = 9;
        $from = $page*$per_page;
        $to = $per_page;

        $sort_what = !isset($_POST['sort_what']) && $_POST['sort_what']!='created' ? 'created' : $_POST['sort_what'];
        $sort_order = !isset($_POST['sort_order']) && $_POST['sort_order']!='ASC' && !$_POST['sort_order']!='DESC' ? 'DESC' : $_POST['sort_order'];
        $order_query = "ORDER by $sort_what $sort_order";


        $submissions = $wpdb->get_results( "SELECT * FROM $offre_table "." $order_query LIMIT $from, $to", ARRAY_A );
        $total = $wpdb->get_var("SELECT COUNT(*) FROM $offre_table ");

        if ( is_array($submissions) && count($submissions)>0 )
        {
            foreach ($submissions as $key => $value) {
                if (((strtotime(current_time('mysql'))-strtotime($submissions[$key]['created']))/(60 * 60 * 24))<1)
                {
                    $submissions[$key]['created'] = $this->edoffre_time_ago(strtotime(current_time('mysql'))-strtotime($submissions[$key]['created']));
                }
                else
                {
                    $submissions[$key]['created'] = date(get_option('date_format'), strtotime($submissions[$key]['created']));
                }
            }
            echo json_encode(array('pages'=>ceil($total/$per_page),'submissions_offres'=>$submissions,'total'=>$total));
            die();
        }
        else
        {
            echo json_encode(array('pages'=>'0','total'=>'0'));
            die();
        }


    }

    function edoffre_time_ago($secs){
        $bit = array(
            ' year'        => $secs / 31556926 % 12,
            ' week'        => $secs / 604800 % 52,
            ' day'        => $secs / 86400 % 7,
            ' hr'        => $secs / 3600 % 24,
            ' min'    => $secs / 60 % 60,
            ' sec'    => $secs % 60
        );


        foreach($bit as $k => $v)
        {
            if($v > 1)$ret[] = $v . $k;
            if($v == 1)$ret[] = $v . $k;
            if (isset($ret)&&count($ret)==2){break;}
        }
        if (isset($ret))
        {
            if (count($ret)>1)
            {
                array_splice($ret, count($ret)-1, 0, 'et');
            }
            return join(' ', $ret);
        }
        return '';
    }
}