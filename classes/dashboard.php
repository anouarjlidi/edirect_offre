<?php
/**
 * Created by PhpStorm.
 * User: edirect
 * Date: 16/11/2015
 * Time: 15:08
 */
?>

<style>
    #toast-container
    {
        top: 10px;
    }
</style>
<div class='edoffre-css'>
    <div class='row' style='position: relative'>
        <div class='medium-12 column ed-brand-header'>
            <h1>eDirect offres</h1>
        </div>
    </div>
    <div class='nav-content' id='main_tabs'>
        <div class='active' data-tab-id='dashboard-tab'>
            <div class='row' style='position: relative; z-index: 101'>
                <div class='large-10 column'>
                    <div class='subs_options'>
                        <h2>Liste de demandeurs</h2>
						<span class='opt-cover'>

						<!--	<span id='search-form'><form id='form-search-form'><i class='fui-search'></i><input id='form-search-input' type='text'></form></span>-->
							<span id='total-results'>0</span>
						</span>
                    </div>
                    <div class='block'>
                        <div class='table_list subs_list_offre' cellpadding='0' cellspacing='0'>
                            <div class='loader'>
                            </div>
                            <div class='tr thead'>
                                <span style='width:5%' class='sortable sortable-ID ASC' data-sort='ID'><?php _e('ID','edaudit'); ?><i class='fui-triangle-down-small'></i><i class='fui-triangle-up-small'></i></span>
                                <span style='width:20%; margin-left: 1px' class='sortable' data-sort='name'><?php _e('Nom & Prénom','edaudit'); ?><i class='fui-triangle-down-small'></i><i class='fui-triangle-up-small'></i></span>
                                <span style='width:10%; margin-left: 1px' class='sortable DESC' data-sort='modified'><?php _e('Nom entreprise','edaudit'); ?><i class='fui-triangle-down-small'></i><i class='fui-triangle-up-small'></i></span>
                                <span style='width:10%; margin-left: 1px' class='sortable DESC' data-sort='modified'><?php _e('Télephone','edaudit'); ?><i class='fui-triangle-down-small'></i><i class='fui-triangle-up-small'></i></span>
                                <span style='width:10%; margin-left: 1px' class='sortable DESC' data-sort='modified'><?php _e('Mobile','edaudit'); ?><i class='fui-triangle-down-small'></i><i class='fui-triangle-up-small'></i></span>
                                <span style='width:15%; margin-left: 1px' class='sortable DESC' data-sort='modified'><?php _e('Email','edaudit'); ?><i class='fui-triangle-down-small'></i><i class='fui-triangle-up-small'></i></span>
                                <span style='width:10%; margin-left: 1px' class='sortable DESC' data-sort='modified'><?php _e('Offre','edaudit'); ?><i class='fui-triangle-down-small'></i><i class='fui-triangle-up-small'></i></span>
                                <span style='width:10%; margin-left: 1px' class='sortable DESC' data-sort='modified'><?php _e('Message','edaudit'); ?><i class='fui-triangle-down-small'></i><i class='fui-triangle-up-small'></i></span>
                                <span style='width:10%; margin-left: 1px' class='sortable DESC' data-sort='modified'><?php _e('Date','edaudit'); ?><i class='fui-triangle-down-small'></i><i class='fui-triangle-up-small'></i></span>
                            </div>
                            <div class='tbody'>
                            </div>

                            <div class='pagination-cover forms-pagination'>
                                <div class='pagination'>
                                    <div style='left: 0px'>
                                        <span>1</span>
                                    </div>
                                </div>
                                <div class='pagination-move'>
                                    <i class='fui-arrow-left'></i>
                                    <i class='fui-arrow-right'></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
