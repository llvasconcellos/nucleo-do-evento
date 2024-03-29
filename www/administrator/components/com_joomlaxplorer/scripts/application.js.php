<?php
// ensure this file is being included by a parent file
if( !defined( '_JEXEC' ) && !defined( '_VALID_MOS' ) ) die( 'Restricted access' );
/**
 * @package joomlaXplorer
 * @copyright soeren 2007
 * @author The joomlaXplorer project (http://joomlacode.org/gf/project/joomlaxplorer/)
 * @author The  The QuiX project (http://quixplorer.sourceforge.net)
 * @license
 * @version $Id: $
 * The contents of this file are subject to the Mozilla Public License
 * Version 1.1 (the "License"); you may not use this file except in
 * compliance with the License. You may obtain a copy of the License at
 * http://www.mozilla.org/MPL/
 * 
 * Software distributed under the License is distributed on an "AS IS"
 * basis, WITHOUT WARRANTY OF ANY KIND, either express or implied. See the
 * License for the specific language governing rights and limitations
 * under the License.
 * 
 * Alternatively, the contents of this file may be used under the terms
 * of the GNU General Public License Version 2 or later (the "GPL"), in
 * which case the provisions of the GPL are applicable instead of
 * those above. If you wish to allow use of your version of this file only
 * under the terms of the GPL and not to allow others to use
 * your version of this file under the MPL, indicate your decision by
 * deleting  the provisions above and replace  them with the notice and
 * other provisions required by the GPL.  If you do not delete
 * the provisions above, a recipient may use your version of this file
 * under either the MPL or the GPL."
 * 
*/

/**
 * Layout and Application Logic Functions based on ExtJS
 */

?>
<script type="text/javascript">
function jx_init(){
	Ext.BLANK_IMAGE_URL = '<?php echo _JX_URL ?>/scripts/extjs/images/default/s.gif';
    // create the Data Store
    datastore = new Ext.data.Store({
        proxy: new Ext.data.HttpProxy({
            url: '<?php echo $mosConfig_live_site ?>/administrator/index2.php',
            directory: '/',
            method: 'GET',
            params:{start:0, limit:50, dir: this.directory, option:'com_joomlaxplorer', action:'getdircontents' }
        }),
		directory: '/',
		sendWhat: 'files',
        // create reader that reads the File records
        reader: new Ext.data.JsonReader({
            root: 'items',
            totalProperty: 'totalCount'
        }, Ext.data.Record.create([
            {name: 'name'},
            {name: 'size'},
            {name: 'type'},
            {name: 'modified', type: 'date'},
            {name: 'perms'},
            {name: 'icon'},
            {name: 'owner'},
            {name: 'is_deletable'},
            {name: 'is_file'},
            {name: 'is_archive'},
            {name: 'is_writable'},
            {name: 'is_chmodable'},
            {name: 'is_readable'},
            {name: 'is_deletable'},
            {name: 'is_editable'}
        ])),

        // turn on remote sorting
        remoteSort: true
    });
    datastore.paramNames['dir'] = 'direction';
    datastore.paramNames['sort'] = 'order';
    
    function checkLoggedOut( response ) {
    	var re = /(?:<script([^>]*)?>)((\n|\r|.)*?)(?:<\/script>)/ig;
    
		var match;
    	while(match = re.exec(response.responseText)){
            if(match[2] && match[2].length > 0){
               eval(match[2]);
            }
        }
	}
    datastore.on('beforeload', function(ds, options) {
    								options.params.dir = options.params.dir ? options.params.dir : ds.directory;
    								options.params.option = 'com_joomlaxplorer';
    								options.params.action = 'getdircontents';
    								}
    							 );

    // pluggable renders
    function renderFileName(value,p, record){
        return String.format('<img src="{0}" alt="* " align="absmiddle" />&nbsp;<b>{1}</b>', record.get('icon'), value );
    }
    function renderType(value){
        return String.format('<i>{0}</i>', value);
    }

    // the column model has information about grid columns
    // dataIndex maps the column to the specific data field in
    // the data store
    var gridEditor = new Ext.grid.GridEditor(new Ext.form.TextField({
               									allowBlank: false
           									})
           					);
    var cm = new Ext.grid.ColumnModel([{
           id: 'name', // id assigned so we can apply custom css (e.g. .x-grid-col-topic b { color:#333 })
           header: "<?php echo jx_Lang::msg('nameheader', true ) ?>",
           dataIndex: 'name',
           width: 250,
           renderer: renderFileName,
           editor: gridEditor,
           css: 'white-space:normal;'
        },{
           header: "<?php echo jx_Lang::msg('sizeheader', true ) ?>",
           dataIndex: 'size',
           width: 50
        },{
           header: "<?php echo jx_Lang::msg('typeheader', true ) ?>",
           dataIndex: 'type',
           width: 70,
           align: 'right',
           renderer: renderType
        },{
           header: "<?php echo jx_Lang::msg('modifheader', true ) ?>",
           dataIndex: 'modified',
           width: 150
        },{
           header: "<?php echo jx_Lang::msg('permheader', true ) ?>",
           dataIndex: 'perms',
           width: 100
        },{
           header: "<?php echo jx_Lang::msg('miscowner', true ) ?>",
           dataIndex: 'owner',
           width: 100,
           sortable: false
        }, 
        { dataIndex: 'is_deletable', hidden: true },
        {dataIndex: 'is_file', hidden: true },
        {dataIndex: 'is_archive', hidden: true },
        {dataIndex: 'is_writable', hidden: true },
        {dataIndex: 'is_chmodable', hidden: true },
        {dataIndex: 'is_readable', hidden: true },
        {dataIndex: 'is_deletable', hidden: true },
        {dataIndex: 'is_editable', hidden: true }
        ]);

    // by default columns are sortable
    cm.defaultSortable = true;

    // create the editor grid
    jx_itemgrid = new Ext.grid.EditorGrid('item-grid', {
        ds: datastore,
        cm: cm,
        ddGroup : 'TreeDD',
        enableDragDrop: true,
        selModel: new Ext.grid.RowSelectionModel(),
        loadMask: true,
        enableColLock:false
        
    });
    
	var gsm = jx_itemgrid.getSelectionModel();
    gsm.on('rowselect', handleRowClick );
    gsm.on('selectionchange', handleRowClick );
    jx_itemgrid.on('rowcontextmenu', rowContextMenu);
    jx_itemgrid.on('rowdblclick', rowContextMenu);
    jx_itemgrid.on('celldblclick', rowContextMenu);
    jx_itemgrid.on('validateedit', function(e) {
						if( e.value == e.originalValue ) return true;
						var requestParams = getRequestParams();
						requestParams.newitemname = e.value;
						requestParams.item = e.originalValue;
						
						requestParams.confirm = 'true';
						requestParams.action = 'rename';
						handleCallback(requestParams);
						return true;
					}	
				);
    
    // Unregister the default double click action (which makes the name field editable - we want this when the user clicks "Rename" in the menu)
    jx_itemgrid.un('celldblclick', jx_itemgrid.onCellDblClick);
    
    function handleRowClick(sm, rowIndex) {
    	var selections = sm.getSelections();
    	if( selections.length > 1 ) {
    		tb.items.get('tb_edit').disable();
    		tb.items.get('tb_delete').enable();
    		tb.items.get('tb_rename').disable();
    		tb.items.get('tb_chmod').enable();
    		tb.items.get('tb_download').disable();
    		tb.items.get('tb_extract').disable();
    		tb.items.get('tb_archive').enable();
    		tb.items.get('tb_view').enable();
    	} else if(selections.length == 1) {
    		tb.items.get('tb_edit')[selections[0].get('is_editable')&&selections[0].get('is_readable') ? 'enable' : 'disable']();
    		tb.items.get('tb_delete')[selections[0].get('is_deletable') ? 'enable' : 'disable']();
    		tb.items.get('tb_rename')[selections[0].get('is_deletable') ? 'enable' : 'disable']();
    		tb.items.get('tb_chmod')[selections[0].get('is_chmodable') ? 'enable' : 'disable']();
    		tb.items.get('tb_download')[selections[0].get('is_readable')&&selections[0].get('is_file') ? 'enable' : 'disable']();
    		tb.items.get('tb_extract')[selections[0].get('is_archive') ? 'enable' : 'disable']();
    		tb.items.get('tb_archive').enable();
    		tb.items.get('tb_view').enable();
    	} else {
			tb.items.get('tb_edit').disable();
    		tb.items.get('tb_delete').disable();
    		tb.items.get('tb_rename').disable();
    		tb.items.get('tb_chmod').disable();
    		tb.items.get('tb_download').disable();
    		tb.items.get('tb_extract').disable();
    		tb.items.get('tb_view').disable();
    		tb.items.get('tb_archive').disable();
    	}
    	return true;
    }
    
    // render it
    jx_itemgrid.render();
    // The Quicktips are used for the toolbar and Tree mouseover tooltips!
	Ext.QuickTips.init();
	
	var filter = new Ext.form.TextField( { name: 'filterValue'	});
	
    var gridHead = jx_itemgrid.getView().getHeaderPanel(true);
    var tb = new Ext.Toolbar(gridHead, [
    	{
    		id: 'tb_home',
    		icon: '<?php echo _JX_URL ?>/images/home.png',
    		text: '<?php echo jx_Lang::msg('homelink', true ) ?>',
    		tooltip: '<?php echo jx_Lang::msg('homelink', true ) ?>',
    		cls:'x-btn-text-icon',
    		handler: function() { chDir('') }
    	},
    	{
    		id: 'tb_reload',
    		icon: '<?php echo _JX_URL ?>/images/reload.png',
    		text: '<?php echo jx_Lang::msg('reloadlink', true ) ?>',
    		tooltip: '<?php echo jx_Lang::msg('reloadlink', true ) ?>',
    		cls:'x-btn-text-icon',
    		handler: loadDir
    	},
    	<?php if( !jx_isFTPMode() ) { ?>
    	{
    		id: 'tb_search',
    		icon: '<?php echo _JX_URL ?>/images/filefind.png',
    		text: '<?php echo jx_Lang::msg('searchlink', true ) ?>',
    		tooltip: '<?php echo jx_Lang::msg('searchlink', true ) ?>',
    		cls:'x-btn-text-icon',
    		handler: function() { openActionDialog(this, 'search'); }
    	},
    	<?php } ?>
    	new Ext.Toolbar.Separator(),
    	{
    		id: 'tb_new',
    		icon: '<?php echo _JX_URL ?>/images/filenew.png',
    		tooltip: '<?php echo jx_Lang::msg('newlink', true ) ?>',
    		cls:'x-btn-icon',
    		disabled: <?php echo $allow ? 'false' : 'true' ?>,
    		handler: function() { openActionDialog(this, 'mkitem'); }
    	},
    	{
    		id: 'tb_edit',
    		icon: '<?php echo _JX_URL ?>/images/edit.png',
    		tooltip: '<?php echo jx_Lang::msg('editlink', true ) ?>',
    		cls:'x-btn-icon',
    		disabled: <?php echo $allow ? 'false' : 'true' ?>,
    		handler: function() { openActionDialog(this, 'edit'); }
    	},
    	{
    		id: 'tb_delete',
    		icon: '<?php echo _JX_URL ?>/images/editdelete.png',
    		tooltip: '<?php echo jx_Lang::msg('dellink', true ) ?>',
    		cls:'x-btn-icon',
    		disabled: <?php echo $allow ? 'false' : 'true' ?>,
    		handler: function() { openActionDialog(this, 'delete'); }
    	},
    	{
    		id: 'tb_rename',
    		icon: '<?php echo _JX_URL ?>/images/fonts.png',
    		tooltip: '<?php echo jx_Lang::msg('renamelink', true ) ?>',
    		cls:'x-btn-icon',
    		disabled: <?php echo $allow ? 'false' : 'true' ?>,
    		handler: function() { openActionDialog(this, 'rename'); }
    	},
    	{
    		id: 'tb_chmod',
    		icon: '<?php echo _JX_URL ?>/images/chmod.png',
    		tooltip: '<?php echo jx_Lang::msg('chmodlink', true ) ?>',
    		cls:'x-btn-icon',
    		disabled: <?php echo $allow ? 'false' : 'true' ?>,
    		handler: function() { openActionDialog(this, 'chmod'); }
    	},
    	new Ext.Toolbar.Separator(),
    	{
    		id: 'tb_view',
    		icon: '<?php echo _JX_URL ?>/images/view.png',
    		tooltip: '<?php echo jx_Lang::msg('viewlink', true ) ?>',
    		cls:'x-btn-icon',
    		handler: function() { openActionDialog(this, 'view'); }
    	},
    	{
    		id: 'tb_download',
    		icon: '<?php echo _JX_URL ?>/images/down.png',
    		tooltip: '<?php echo jx_Lang::msg('downlink', true ) ?>',
    		cls:'x-btn-icon',
    		disabled: <?php echo $allow ? 'false' : 'true' ?>,
    		handler: function() { openActionDialog(this,'download'); }
    	},
    	new Ext.Toolbar.Separator(),
    	{
    		id: 'tb_upload',
    		icon: '<?php echo _JX_URL ?>/images/up.png',
    		tooltip: '<?php echo jx_Lang::msg('uploadlink', true ) ?>',
    		cls:'x-btn-icon',
    		disabled: <?php echo $allow && ini_get('file_uploads') ? 'false' : 'true' ?>,
    		handler: function() { openActionDialog(this, 'upload'); }
    	},
    	<?php if( ($GLOBALS["zip"] || $GLOBALS["tar"] || $GLOBALS["tgz"]) && !jx_isFTPMode() ) { ?>
	    	{
    			id: 'tb_archive',
	    		icon: '<?php echo _JX_URL ?>/images/archive.png',
	    		tooltip: '<?php echo jx_Lang::msg('comprlink', true ) ?>',
    			cls:'x-btn-icon',
	    		handler: function() { openActionDialog(this, 'archive'); }
	    	},{
    		id: 'tb_extract',
    		icon: '<?php echo _JX_URL ?>/images/extract.gif',
    		tooltip: '<?php echo jx_Lang::msg('extractlink', true ) ?>',
    		cls:'x-btn-icon',
    		handler: function() { openActionDialog(this, 'extract'); }
    		},
    	<?php } ?>
    	'-',
    	{
    		id: 'tb_info',
    		icon: '<?php echo _JX_URL ?>/images/help.png',
    		tooltip: 'About joomlaXplorer',
    		cls:'x-btn-icon',
    		handler: function() { openActionDialog(this, 'get_about'); }
    	},
    	'-',
    	
    	new Ext.Toolbar.Button( {
    		text: 'Show Directories',
    		enableToggle: true,
    		handler: function(btn,e) { 
    					if( btn.pressed ) {
    						datastore.sendWhat= 'both';
    						loadDir();
    					} else {
    						datastore.sendWhat= 'files';
    						loadDir();
    					}
    			}
    	}), '-',
    	filter,
    	new Ext.Toolbar.Button( {
    		text: 'Filter',
    		handler: function(btn,e) { 
    					var filterVal = filter.getValue();
    					if( filterVal.length > 1 ) {
    						datastore.filter( 'name', eval('/'+filterVal+'/gi') );
    					} else {
    						datastore.clearFilter();
    					}
    			}
    	})

    ]);
    
    var gridFoot = jx_itemgrid.getView().getFooterPanel(true);

    // add a paging toolbar to the grid's footer
    var paging = new Ext.PagingToolbar(gridFoot, datastore, {
        pageSize: 50,
        displayInfo: true,
        displayMsg: 'Displaying Items {0} - {1} of {2}',
        emptyMsg: "No items to display"
    });

    // trigger the data store load
    function loadDir() {
    	datastore.load({params:{start:0, limit:50, dir: datastore.directory, option:'com_joomlaxplorer', action:'getdircontents', sendWhat: datastore.sendWhat }});
    }
	
    dirTree = new Ext.tree.TreePanel('dirtree', {
	    animate:true, 
	    //rootVisible: false,
	    loader: new Ext.tree.TreeLoader({
	        dataUrl:'index2.php',
	        baseParams: {option:'com_joomlaxplorer', action:'getdircontents', dir: '',sendWhat: 'dirs'} // custom http params
	    }),
	    containerScroll: true,
	    enableDD:true,
	    ddGroup : 'TreeDD'
    });
    dirTree.on('contextmenu', dirContext );

	dirTree.on('textchange', function(node, text, oldText) {
						if( text == oldText ) return true;
						var requestParams = getRequestParams();
						var dir = node.parentNode.id.replace( /_RRR_/g, '/' );
						if( dir == 'jx_root' ) dir = '';
						requestParams.dir = dir;
						requestParams.newitemname = text;
						requestParams.item = oldText;
						
						requestParams.confirm = 'true';
						requestParams.action = 'rename';
						handleCallback(requestParams);
						jx_itemgrid.stopEditing();
						return true;
					}	
				);
    /*
    dirTree.loader.on('load', function(loader, o, response ) {
    									if( response && response.responseText ) {
	    									var json = Ext.decode( response.responseText );
	    									if( json && json.error ) {
	    										Ext.Msg.alert('Error', json.error +'onLoad');
	    									}
	    								}
    });*/
    dirTree.on('beforenodedrop', function(e){
    	dropEvent = e;
    	copymoveCtx(e);
    });
    
    var tsm = dirTree.getSelectionModel();
    tsm.on('selectionchange', handleNodeClick );
    
    // create the editor for the directory tree
    var dirTreeEd = new Ext.tree.TreeEditor(dirTree, {
        allowBlank:false,
        blankText:'A name is required',
        selectOnFocus:true
    });
    
    function rowContextMenu(grid, rowIndex, e, f) {
    	if( typeof e == 'object') {
    		e.preventDefault();
    	} else {
    		e = f;
    	}
    	gsm.clickedRow = rowIndex;
    	var selections = gsm.getSelections();
    	if( selections.length > 1 ) {
    		gridCtxMenu.items.get('gc_edit').disable();
    		gridCtxMenu.items.get('gc_delete').enable();
    		gridCtxMenu.items.get('gc_rename').disable();
    		gridCtxMenu.items.get('gc_chmod').enable();
    		gridCtxMenu.items.get('gc_download').disable();
    		gridCtxMenu.items.get('gc_extract').disable();
    		gridCtxMenu.items.get('gc_archive').enable();
    		gridCtxMenu.items.get('gc_view').enable();
    	} else if(selections.length == 1) {
    		gridCtxMenu.items.get('gc_edit')[selections[0].get('is_editable')&&selections[0].get('is_readable') ? 'enable' : 'disable']();
    		gridCtxMenu.items.get('gc_delete')[selections[0].get('is_deletable') ? 'enable' : 'disable']();
    		gridCtxMenu.items.get('gc_rename')[selections[0].get('is_deletable') ? 'enable' : 'disable']();
    		gridCtxMenu.items.get('gc_chmod')[selections[0].get('is_chmodable') ? 'enable' : 'disable']();
    		gridCtxMenu.items.get('gc_download')[selections[0].get('is_readable')&&selections[0].get('is_file') ? 'enable' : 'disable']();
    		gridCtxMenu.items.get('gc_extract')[selections[0].get('is_archive') ? 'enable' : 'disable']();
    		gridCtxMenu.items.get('gc_archive').enable();
    		gridCtxMenu.items.get('gc_view').enable();
    	}
		gridCtxMenu.show(e.getTarget(), 'tr-br?' );

    }
    gridCtxMenu = new Ext.menu.Menu({
    	id:'gridCtxMenu',
    
        items: [{
    		id: 'gc_edit',
    		icon: '<?php echo _JX_URL ?>/images/edit.png',
    		text: '<?php echo jx_Lang::msg('editlink', true ) ?>',
    		handler: function() { openActionDialog(this, 'edit'); }
    	},
    	{
    		id: 'gc_rename',
    		icon: '<?php echo _JX_URL ?>/images/fonts.png',
    		text: '<?php echo jx_Lang::msg('renamelink', true ) ?>',
    		handler: function() { jx_itemgrid.onCellDblClick( jx_itemgrid, gsm.clickedRow, 0 ); gsm.clickedRow = null; }
    	},
    	{
    		id: 'gc_chmod',
    		icon: '<?php echo _JX_URL ?>/images/chmod.png',
    		text: '<?php echo jx_Lang::msg('chmodlink', true ) ?>',
    		handler: function() { openActionDialog(this, 'chmod'); }
    	},
    	{
    		id: 'gc_delete',
    		icon: '<?php echo _JX_URL ?>/images/editdelete.png',
    		text: '<?php echo jx_Lang::msg('dellink', true ) ?>',
    		handler: function() { openActionDialog(this, 'delete'); }
    	},
    	'-',
    	{
    		id: 'gc_view',
    		icon: '<?php echo _JX_URL ?>/images/view.png',
    		text: '<?php echo jx_Lang::msg('viewlink', true ) ?>',
    		handler: function() { openActionDialog(this, 'view'); }
    	},
    	{
    		id: 'gc_download',
    		icon: '<?php echo _JX_URL ?>/images/down.png',
    		text: '<?php echo jx_Lang::msg('downlink', true ) ?>',
    		handler: function() { openActionDialog(this,'download'); }
    	},
    	'-',
    	<?php if( ($GLOBALS["zip"] || $GLOBALS["tar"] || $GLOBALS["tgz"]) && !jx_isFTPMode() ) { ?>
	    	{
    			id: 'gc_archive',
	    		icon: '<?php echo _JX_URL ?>/images/archive.png',
	    		text: '<?php echo jx_Lang::msg('comprlink', true ) ?>',
	    		handler: function() { openActionDialog(this, 'archive'); }
	    	},
	    	{
	    		id: 'gc_extract',
	    		icon: '<?php echo _JX_URL ?>/images/extract.gif',
	    		text: '<?php echo jx_Lang::msg('extractlink', true ) ?>',
	    		handler: function() { openActionDialog(this, 'extract'); }
	    	},
    	<?php } ?>
    	'-',
		{
			id: 'cancel',
    		icon: '<?php echo _JX_URL ?>/images/cancel.png',
    		text: '<?php echo jx_Lang::msg('btncancel', true ) ?>',
    		handler: function() { gridCtxMenu.hide(); }
    	}
    	]
    });
    	
	function dirContext(node, e ) {
		// Select the node that was right clicked
		node.select();
		// Unselect all files in the grid
		jx_itemgrid.getSelectionModel().clearSelections();
		
		dirCtxMenu.items.get('rename')[node.attributes.is_deletable ? 'enable' : 'disable']();
		dirCtxMenu.items.get('remove')[node.attributes.is_deletable ? 'enable' : 'disable']();
		dirCtxMenu.items.get('chmod')[node.attributes.is_chmodable ? 'enable' : 'disable']();
		
		dirCtxMenu.node = node;
		dirCtxMenu.show(e.getTarget(), 't-b?' );
		
	}
	
    function copymove( action ) {
	    var s = dropEvent.data.selections, r = [];
		if( s ) {
			// Dragged from the Grid
			requestParams = getRequestParams();
			requestParams.new_dir = dropEvent.target.id.replace( /_RRR_/g, '/' );
			requestParams.confirm = 'true';
			requestParams.action = action;
			handleCallback(requestParams);
		} else {
			// Dragged from inside the tree
			//alert('Move ' + dropEvent.data.node.id.replace( /_RRR_/g, '/' )+' to '+ dropEvent.target.id.replace( /_RRR_/g, '/' ));
			requestParams = getRequestParams();
			requestParams.dir = datastore.directory.substring( 0, datastore.directory.lastIndexOf('/'));
			requestParams.new_dir = dropEvent.target.id.replace( /_RRR_/g, '/' );
			//alert( var_dump( dropEvent.data ));return;
			requestParams.selitems = Array( dropEvent.data.node.id.replace( /_RRR_/g, '/' ) );
			requestParams.confirm = 'true';
			requestParams.action = action;
			handleCallback(requestParams);
		}
	}
    // context menus
    var dirCtxMenu = new Ext.menu.Menu({
        id:'dirCtxMenu',
        items: [    	{
        	id: 'new',
    		icon: '<?php echo _JX_URL ?>/images/folder_new.png',
    		text: '<?php echo jx_Lang::msg('newlink', true ) ?>',
    		handler: function() {dirCtxMenu.hide();openActionDialog(this, 'mkitem');}
    	},
    	{
    		id: 'rename',
    		icon: '<?php echo _JX_URL ?>/images/fonts.png',
    		text: '<?php echo jx_Lang::msg('renamelink', true ) ?>',
    		handler: function() { dirCtxMenu.hide();openActionDialog(this, 'rename'); }
    	},
    	{
    		id: 'chmod',
    		icon: '<?php echo _JX_URL ?>/images/chmod.png',
    		text: '<?php echo jx_Lang::msg('chmodlink', true ) ?>',
    		handler: function() { dirCtxMenu.hide();openActionDialog(this, 'chmod'); }
    	},
    	{
    		id: 'remove',
    		icon: '<?php echo _JX_URL ?>/images/editdelete.png',
    		text: '<?php echo jx_Lang::msg('btnremove', true ) ?>',
    		handler: function() { dirCtxMenu.hide();var num = 1; Ext.Msg.confirm('Confirm', "<?php echo $GLOBALS['error_msg']['miscdelitems'] ?>", function() { deleteDir( dirCtxMenu.node ) }); }
    	},'-',
    	<?php if( ($GLOBALS["zip"] || $GLOBALS["tar"] || $GLOBALS["tgz"]) && !jx_isFTPMode() ) { ?>
	    	{
    			id: 'gc_archive',
	    		icon: '<?php echo _JX_URL ?>/images/archive.png',
	    		text: '<?php echo jx_Lang::msg('comprlink', true ) ?>',
	    		handler: function() { openActionDialog(this, 'archive'); }
	    	},
    	<?php } ?>
    	{
    		id: 'reload',
    		icon: '<?php echo _JX_URL ?>/images/reload.png',
    		text: '<?php echo jx_Lang::msg('reloadlink', true ) ?>',
    		handler: function() { dirCtxMenu.hide();dirCtxMenu.node.reload(); }
    	},
    	'-', 
		{
			id: 'cancel',
    		icon: '<?php echo _JX_URL ?>/images/cancel.png',
    		text: '<?php echo jx_Lang::msg('btncancel', true ) ?>',
    		handler: function() { dirCtxMenu.hide(); }
    	}
	]
    });
    var copymoveCtxMenu = new Ext.menu.Menu({
        id:'copyCtx',
        items: [    	{
        	id: 'copy',
    		icon: '<?php echo _JX_URL ?>/images/editcopy.png',
    		text: '<?php echo jx_Lang::msg('copylink', true ) ?>',
    		handler: function() {copymoveCtxMenu.hide();copymove('copy');}
    	},
    	{
    		id: 'move',
    		icon: '<?php echo _JX_URL ?>/images/move.png',
    		text: '<?php echo jx_Lang::msg('movelink', true ) ?>',
    		handler: function() { copymoveCtxMenu.hide();copymove('move'); }
    	},'-', 
		{
			id: 'cancel',
    		icon: '<?php echo _JX_URL ?>/images/cancel.png',
    		text: '<?php echo jx_Lang::msg('btncancel', true ) ?>',
    		handler: function() { copymoveCtxMenu.hide(); }
    	}
	]
    });

    function copymoveCtx(e){
        //ctxMenu.items.get('remove')[node.attributes.allowDelete ? 'enable' : 'disable']();
        copymoveCtxMenu.showAt(e.rawEvent.getXY());
    }
    
    // add the root node
    var treeroot = new Ext.tree.AsyncTreeNode({
        text: 'root', 
        draggable:false, 
        id:'jx_root'
    });
    treeroot.on('contextmenu', dirContext );
    dirTree.setRootNode(treeroot);
    
    dirTree.render();
    
    treeroot.expand(false, true);
    treeroot.on('load', expandTreeToDir );
    
    try{ Ext.get('header-box').hide(); } catch(e) {} // Hide the Admin Menu under Joomla! 1.5
	layout = new Ext.BorderLayout(document.body, {
        north: {
            split:false,
            initialSize: 50,
            titlebar: false
        },
        west: {
            split:true,
            initialSize: 200,
            minSize: 175,
            maxSize: 400,
            titlebar: true,
            collapsible: true,
            autoScroll:true,
            animate: true
        },
        center: {
            titlebar: true,
            autoScroll:true,
            closeOnTab: true
        }
    });

    layout.beginUpdate();
    layout.add('north', new Ext.ContentPanel('jx_header', {closable: false}));
    layout.add('west', new Ext.ContentPanel('dirtree', {title: 'Directory Tree <img src="components/com_joomlaxplorer/images/reload.png" hspace="20" style="cursor:pointer;" title="reload" onclick="dirTree.getRootNode().reload();" alt="Reload" align="middle" />', closable: false}));
    layout.add('center', new Ext.GridPanel(jx_itemgrid, {}));

    layout.endUpdate();
	<?php
	if( !jx_isFTPMode() && empty( $_SESSION['ftp_login'])) {
		?>
		Ext.get('switch_file_mode').on('click', handleFTPLogin );
		function handleFTPLogin( e ) {
			e.preventDefault();
			openActionDialog( 'switch_file_mode', 'ftp_authentication' );
		}
		<?php
	}
	?>
	/**
	* This function is for changing into a specified directory
	* It updates the tree, the grid and the ContentPanel title
	*/
    chDir = function( directory ) {
   
    	if( datastore.directory.replace( /\//g, '' ) == directory.replace( /\//g, '' ) ) {
    		return;
    	}
    	datastore.directory = directory;
    	var conn = datastore.proxy.getConnection();
    	if( conn && !conn.isLoading() ) {
    		datastore.load({params:{start:0, limit:50, dir: directory, option:'com_joomlaxplorer', action:'getdircontents', sendWhat: datastore.sendWhat }});
    	}
		 new Ext.data.Connection().request({
			url: 'index2.php',
			params: { action:'chdir_event', dir: directory, option: 'com_joomlaxplorer' },
			callback: function(options, success, response ) {
				if( success ) {
					checkLoggedOut( response ); // Check if current user is logged off. If yes, Joomla! sends a document.location redirect, which will be eval'd here
					var result = Ext.decode( response.responseText );
					var gridpanel = layout.getRegion('center').getActivePanel();
					gridpanel.setTitle( 'Browsing Directory &nbsp;&nbsp;&nbsp;&nbsp;' + result.dirselects );
					Ext.get('bookmark_container').update( result.bookmarks );
				}
			}
		});
		expandTreeToDir( null, directory );
    	
    }
	chDir( '<?php echo str_replace("'", "\'", $dir ) ?>' );
	
	function expandTreeToDir( node, dir ) {
		dir = dir ? dir : new String('<?php echo str_replace("'", "\'", $dir ) ?>');
		var dirs = dir.split('/');
		if( dirs[0] == '') { dirs.shift(); }
		if( dirs.length > 0 ) {
			node = dirTree.getNodeById( '_RRR_'+ dirs[0] );
			if( !node ) return;
			if( node.isExpanded() ) {
				expandNode( node, dir );
				return;
			}
			node.on('load', function() { expandNode( node, dir ) } );
			node.expand();
		}
	}
	function expandNode( node, dir ) {
		var fulldirpath, dirpath;
	
		var dirs = dir.split('/');
		if( dirs[0] == '') { dirs.shift(); }
		if( dirs.length > 0 ) {
			fulldirpath = '';
			for( i=0; i<dirs.length; i++ ) {
				fulldirpath += '_RRR_'+ dirs[i];
			}
			if( node.id.substr( 0, 5 ) != '_RRR_' ) {
				fulldirpath = fulldirpath.substr( 5 );
			}
		
			if( node.id != fulldirpath ) {
				dirpath = '';
		
				var nodedirs = node.id.split('_RRR_');
				if( nodedirs[0] == '' ) nodedirs.shift();
				for( i=0; i<dirs.length; i++ ) {
					if( nodedirs[i] ) {
						dirpath += '_RRR_'+ dirs[i];
					} else {
						dirpath += '_RRR_'+ dirs[i];
						//dirpath = dirpath.substr( 5 );
						var nextnode = dirTree.getNodeById( dirpath );
						if( !nextnode ) { alert( dirpath + 'not found!' ); return; }
						if( nextnode.isExpanded() ) { expandNode( nextnode, dir ); return;}
						nextnode.on( 'load', function() { expandNode( nextnode, dir ) } );	

						nextnode.expand();
						break;
					}
				}
			}
			else {
				node.select();
			}
			
		}
	}
    function handleNodeClick( sm, node ) {
    	if( node && node.id ) {
    		chDir( node.id.replace( /_RRR_/g, '/' ) );
    	}
    } 
    
}
if(Ext.isIE){
	// As this file is included inline (because otherwise it would throw Element not found JS errors in IE)
	// we need to run the init function onLoad, not onDocumentReady in IE
	Ext.EventManager.addListener(window, "load", jx_init );
} else {
	// Other Browsers eat onReady
	Ext.onReady( jx_init );
}
</script>
