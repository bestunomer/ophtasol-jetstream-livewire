<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *                                   ATTENTION!
 * If you see this message in your browser (Internet Explorer, Mozilla Firefox, Google Chrome, etc.)
 * this means that PHP is not properly installed on your web server. Please refer to the PHP manual
 * for more details: http://php.net/manual/install.php 
 *
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 */

    include_once dirname(__FILE__) . '/components/startup.php';
    include_once dirname(__FILE__) . '/components/application.php';
    include_once dirname(__FILE__) . '/' . 'authorization.php';


    include_once dirname(__FILE__) . '/' . 'database_engine/mysql_engine.php';
    include_once dirname(__FILE__) . '/' . 'components/page/page_includes.php';

    function GetConnectionOptions()
    {
        $result = GetGlobalConnectionOptions();
        $result['client_encoding'] = 'utf8';
        GetApplication()->GetUserAuthentication()->applyIdentityToConnectionOptions($result);
        return $result;
    }

    
    
    
    // OnBeforePageExecute event handler
    
    
    
    class employment_categoryPage extends Page
    {
        protected function DoBeforeCreate()
        {
            $this->SetTitle('Employment Category');
            $this->SetMenuLabel('Employment Category');
            $this->SetHeader(GetPagesHeader());
            $this->SetFooter(GetPagesFooter());
    
            $this->dataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`employment_category`');
            $this->dataset->addFields(
                array(
                    new IntegerField('employment_cat_id', true, true, true),
                    new StringField('employment_cat_k'),
                    new StringField('employment_cat_a'),
                    new StringField('employment_cat_e')
                )
            );
        }
    
        protected function DoPrepare() {
    
        }
    
        protected function CreatePageNavigator()
        {
            $result = new CompositePageNavigator($this);
            
            $partitionNavigator = new PageNavigator('pnav', $this, $this->dataset);
            $partitionNavigator->SetRowsPerPage(100);
            $result->AddPageNavigator($partitionNavigator);
            
            return $result;
        }
    
        protected function CreateRssGenerator()
        {
            return null;
        }
    
        protected function setupCharts()
        {
    
        }
    
        protected function getFiltersColumns()
        {
            return array(
                new FilterColumn($this->dataset, 'employment_cat_id', 'employment_cat_id', 'Employment Cat Id'),
                new FilterColumn($this->dataset, 'employment_cat_k', 'employment_cat_k', 'Employment Cat K'),
                new FilterColumn($this->dataset, 'employment_cat_a', 'employment_cat_a', 'Employment Cat A'),
                new FilterColumn($this->dataset, 'employment_cat_e', 'employment_cat_e', 'Employment Cat E')
            );
        }
    
        protected function setupQuickFilter(QuickFilter $quickFilter, FixedKeysArray $columns)
        {
            $quickFilter
                ->addColumn($columns['employment_cat_k'])
                ->addColumn($columns['employment_cat_a'])
                ->addColumn($columns['employment_cat_e']);
        }
    
        protected function setupColumnFilter(ColumnFilter $columnFilter)
        {
    
        }
    
        protected function setupFilterBuilder(FilterBuilder $filterBuilder, FixedKeysArray $columns)
        {
    
        }
    
        protected function AddOperationsColumns(Grid $grid)
        {
            $actions = $grid->getActions();
            $actions->setCaption($this->GetLocalizerCaptions()->GetMessageString('Actions'));
            $actions->setPosition(ActionList::POSITION_LEFT);
            
            if ($this->GetSecurityInfo()->HasViewGrant())
            {
                $operation = new AjaxOperation(OPERATION_VIEW,
                    $this->GetLocalizerCaptions()->GetMessageString('View'),
                    $this->GetLocalizerCaptions()->GetMessageString('View'), $this->dataset,
                    $this->GetModalGridViewHandler(), $grid);
                $operation->setUseImage(false);
                $actions->addOperation($operation);
            }
            
            if ($this->GetSecurityInfo()->HasEditGrant())
            {
                $operation = new LinkOperation($this->GetLocalizerCaptions()->GetMessageString('Edit'), OPERATION_EDIT, $this->dataset, $grid);
                $operation->setUseImage(false);
                $actions->addOperation($operation);
                $operation->OnShow->AddListener('ShowEditButtonHandler', $this);
            }
            
            if ($this->GetSecurityInfo()->HasAddGrant())
            {
                $operation = new AjaxOperation(OPERATION_COPY,
                    $this->GetLocalizerCaptions()->GetMessageString('Copy'),
                    $this->GetLocalizerCaptions()->GetMessageString('Copy'), $this->dataset,
                    $this->GetModalGridCopyHandler(), $grid);
                $operation->setUseImage(false);
                $actions->addOperation($operation);
            }
        }
    
        protected function AddFieldColumns(Grid $grid, $withDetails = true)
        {
            //
            // View column for employment_cat_k field
            //
            $column = new TextViewColumn('employment_cat_k', 'employment_cat_k', 'Employment Cat K', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('employment_categoryGrid_employment_cat_k_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for employment_cat_a field
            //
            $column = new TextViewColumn('employment_cat_a', 'employment_cat_a', 'Employment Cat A', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('employment_categoryGrid_employment_cat_a_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for employment_cat_e field
            //
            $column = new TextViewColumn('employment_cat_e', 'employment_cat_e', 'Employment Cat E', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('employment_categoryGrid_employment_cat_e_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
        }
    
        protected function AddSingleRecordViewColumns(Grid $grid)
        {
            //
            // View column for employment_cat_k field
            //
            $column = new TextViewColumn('employment_cat_k', 'employment_cat_k', 'Employment Cat K', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('employment_categoryGrid_employment_cat_k_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for employment_cat_a field
            //
            $column = new TextViewColumn('employment_cat_a', 'employment_cat_a', 'Employment Cat A', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('employment_categoryGrid_employment_cat_a_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for employment_cat_e field
            //
            $column = new TextViewColumn('employment_cat_e', 'employment_cat_e', 'Employment Cat E', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('employment_categoryGrid_employment_cat_e_handler_view');
            $grid->AddSingleRecordViewColumn($column);
        }
    
        protected function AddEditColumns(Grid $grid)
        {
            //
            // Edit column for employment_cat_k field
            //
            $editor = new TextEdit('employment_cat_k_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Employment Cat K', 'employment_cat_k', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for employment_cat_a field
            //
            $editor = new TextEdit('employment_cat_a_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Employment Cat A', 'employment_cat_a', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for employment_cat_e field
            //
            $editor = new TextEdit('employment_cat_e_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Employment Cat E', 'employment_cat_e', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
        }
    
        protected function AddMultiEditColumns(Grid $grid)
        {
            //
            // Edit column for employment_cat_k field
            //
            $editor = new TextEdit('employment_cat_k_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Employment Cat K', 'employment_cat_k', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for employment_cat_a field
            //
            $editor = new TextEdit('employment_cat_a_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Employment Cat A', 'employment_cat_a', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for employment_cat_e field
            //
            $editor = new TextEdit('employment_cat_e_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Employment Cat E', 'employment_cat_e', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
        }
    
        protected function AddInsertColumns(Grid $grid)
        {
            //
            // Edit column for employment_cat_k field
            //
            $editor = new TextEdit('employment_cat_k_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Employment Cat K', 'employment_cat_k', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for employment_cat_a field
            //
            $editor = new TextEdit('employment_cat_a_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Employment Cat A', 'employment_cat_a', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for employment_cat_e field
            //
            $editor = new TextEdit('employment_cat_e_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Employment Cat E', 'employment_cat_e', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            $grid->SetShowAddButton(true && $this->GetSecurityInfo()->HasAddGrant());
        }
    
        private function AddMultiUploadColumn(Grid $grid)
        {
    
        }
    
        protected function AddPrintColumns(Grid $grid)
        {
            //
            // View column for employment_cat_k field
            //
            $column = new TextViewColumn('employment_cat_k', 'employment_cat_k', 'Employment Cat K', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('employment_categoryGrid_employment_cat_k_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for employment_cat_a field
            //
            $column = new TextViewColumn('employment_cat_a', 'employment_cat_a', 'Employment Cat A', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('employment_categoryGrid_employment_cat_a_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for employment_cat_e field
            //
            $column = new TextViewColumn('employment_cat_e', 'employment_cat_e', 'Employment Cat E', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('employment_categoryGrid_employment_cat_e_handler_print');
            $grid->AddPrintColumn($column);
        }
    
        protected function AddExportColumns(Grid $grid)
        {
            //
            // View column for employment_cat_k field
            //
            $column = new TextViewColumn('employment_cat_k', 'employment_cat_k', 'Employment Cat K', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('employment_categoryGrid_employment_cat_k_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for employment_cat_a field
            //
            $column = new TextViewColumn('employment_cat_a', 'employment_cat_a', 'Employment Cat A', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('employment_categoryGrid_employment_cat_a_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for employment_cat_e field
            //
            $column = new TextViewColumn('employment_cat_e', 'employment_cat_e', 'Employment Cat E', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('employment_categoryGrid_employment_cat_e_handler_export');
            $grid->AddExportColumn($column);
        }
    
        private function AddCompareColumns(Grid $grid)
        {
            //
            // View column for employment_cat_k field
            //
            $column = new TextViewColumn('employment_cat_k', 'employment_cat_k', 'Employment Cat K', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('employment_categoryGrid_employment_cat_k_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for employment_cat_a field
            //
            $column = new TextViewColumn('employment_cat_a', 'employment_cat_a', 'Employment Cat A', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('employment_categoryGrid_employment_cat_a_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for employment_cat_e field
            //
            $column = new TextViewColumn('employment_cat_e', 'employment_cat_e', 'Employment Cat E', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('employment_categoryGrid_employment_cat_e_handler_compare');
            $grid->AddCompareColumn($column);
        }
    
        private function AddCompareHeaderColumns(Grid $grid)
        {
    
        }
    
        public function GetPageDirection()
        {
            return null;
        }
    
        public function isFilterConditionRequired()
        {
            return false;
        }
    
        protected function ApplyCommonColumnEditProperties(CustomEditColumn $column)
        {
            $column->SetDisplaySetToNullCheckBox(false);
            $column->SetDisplaySetToDefaultCheckBox(false);
    		$column->SetVariableContainer($this->GetColumnVariableContainer());
        }
    
        function GetCustomClientScript()
        {
            return ;
        }
        
        function GetOnPageLoadedClientScript()
        {
            return ;
        }
        
        public function GetEnableModalGridInsert() { return true; }
        public function GetEnableModalSingleRecordView() { return true; }
        
        public function GetEnableModalGridCopy() { return true; }
    
        protected function CreateGrid()
        {
            $result = new Grid($this, $this->dataset);
            if ($this->GetSecurityInfo()->HasDeleteGrant())
               $result->SetAllowDeleteSelected(false);
            else
               $result->SetAllowDeleteSelected(false);   
            
            ApplyCommonPageSettings($this, $result);
            
            $result->SetUseImagesForActions(false);
            $result->SetUseFixedHeader(true);
            $result->SetShowLineNumbers(true);
            $result->SetShowKeyColumnsImagesInHeader(false);
            $result->setAllowSortingByClick(false);
            $result->setAllowSortingByDialog(false);
            $result->SetViewMode(ViewMode::TABLE);
            $result->setEnableRuntimeCustomization(false);
            $result->setSelectionFilterAllowed(false);
            $result->setMultiEditAllowed($this->GetSecurityInfo()->HasEditGrant() && false);
            $result->setTableBordered(true);
            $result->setTableCondensed(true);
            
            $result->SetHighlightRowAtHover(true);
            $result->SetWidth('');
            $this->AddOperationsColumns($result);
            $this->AddFieldColumns($result);
            $this->AddSingleRecordViewColumns($result);
            $this->AddEditColumns($result);
            $this->AddMultiEditColumns($result);
            $this->AddInsertColumns($result);
            $this->AddPrintColumns($result);
            $this->AddExportColumns($result);
            $this->AddMultiUploadColumn($result);
    
    
            $this->SetShowPageList(true);
            $this->SetShowTopPageNavigator(true);
            $this->SetShowBottomPageNavigator(true);
            $this->setPrintListAvailable(false);
            $this->setPrintListRecordAvailable(false);
            $this->setPrintOneRecordAvailable(false);
            $this->setAllowPrintSelectedRecords(false);
            $this->setExportListAvailable(array());
            $this->setExportSelectedRecordsAvailable(array());
            $this->setExportListRecordAvailable(array());
            $this->setExportOneRecordAvailable(array());
    
            return $result;
        }
     
        protected function setClientSideEvents(Grid $grid) {
    
        }
    
        protected function doRegisterHandlers() {
            //
            // View column for employment_cat_k field
            //
            $column = new TextViewColumn('employment_cat_k', 'employment_cat_k', 'Employment Cat K', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'employment_categoryGrid_employment_cat_k_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for employment_cat_a field
            //
            $column = new TextViewColumn('employment_cat_a', 'employment_cat_a', 'Employment Cat A', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'employment_categoryGrid_employment_cat_a_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for employment_cat_e field
            //
            $column = new TextViewColumn('employment_cat_e', 'employment_cat_e', 'Employment Cat E', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'employment_categoryGrid_employment_cat_e_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for employment_cat_k field
            //
            $column = new TextViewColumn('employment_cat_k', 'employment_cat_k', 'Employment Cat K', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'employment_categoryGrid_employment_cat_k_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for employment_cat_a field
            //
            $column = new TextViewColumn('employment_cat_a', 'employment_cat_a', 'Employment Cat A', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'employment_categoryGrid_employment_cat_a_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for employment_cat_e field
            //
            $column = new TextViewColumn('employment_cat_e', 'employment_cat_e', 'Employment Cat E', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'employment_categoryGrid_employment_cat_e_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for employment_cat_k field
            //
            $column = new TextViewColumn('employment_cat_k', 'employment_cat_k', 'Employment Cat K', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'employment_categoryGrid_employment_cat_k_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for employment_cat_a field
            //
            $column = new TextViewColumn('employment_cat_a', 'employment_cat_a', 'Employment Cat A', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'employment_categoryGrid_employment_cat_a_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for employment_cat_e field
            //
            $column = new TextViewColumn('employment_cat_e', 'employment_cat_e', 'Employment Cat E', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'employment_categoryGrid_employment_cat_e_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for employment_cat_k field
            //
            $column = new TextViewColumn('employment_cat_k', 'employment_cat_k', 'Employment Cat K', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'employment_categoryGrid_employment_cat_k_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for employment_cat_a field
            //
            $column = new TextViewColumn('employment_cat_a', 'employment_cat_a', 'Employment Cat A', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'employment_categoryGrid_employment_cat_a_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for employment_cat_e field
            //
            $column = new TextViewColumn('employment_cat_e', 'employment_cat_e', 'Employment Cat E', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'employment_categoryGrid_employment_cat_e_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
        }
       
        protected function doCustomRenderColumn($fieldName, $fieldData, $rowData, &$customText, &$handled)
        { 
    
        }
    
        protected function doCustomRenderPrintColumn($fieldName, $fieldData, $rowData, &$customText, &$handled)
        { 
    
        }
    
        protected function doCustomRenderExportColumn($exportType, $fieldName, $fieldData, $rowData, &$customText, &$handled)
        { 
    
        }
    
        protected function doCustomDrawRow($rowData, &$cellFontColor, &$cellFontSize, &$cellBgColor, &$cellItalicAttr, &$cellBoldAttr)
        {
    
        }
    
        protected function doExtendedCustomDrawRow($rowData, &$rowCellStyles, &$rowStyles, &$rowClasses, &$cellClasses)
        {
    
        }
    
        protected function doCustomRenderTotal($totalValue, $aggregate, $columnName, &$customText, &$handled)
        {
    
        }
    
        protected function doCustomDefaultValues(&$values, &$handled) 
        {
    
        }
    
        protected function doCustomCompareColumn($columnName, $valueA, $valueB, &$result)
        {
    
        }
    
        protected function doBeforeInsertRecord($page, &$rowData, $tableName, &$cancel, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doBeforeUpdateRecord($page, $oldRowData, &$rowData, $tableName, &$cancel, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doBeforeDeleteRecord($page, &$rowData, $tableName, &$cancel, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doAfterInsertRecord($page, $rowData, $tableName, &$success, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doAfterUpdateRecord($page, $oldRowData, $rowData, $tableName, &$success, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doAfterDeleteRecord($page, $rowData, $tableName, &$success, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doCustomHTMLHeader($page, &$customHtmlHeaderText)
        { 
    
        }
    
        protected function doGetCustomTemplate($type, $part, $mode, &$result, &$params)
        {
    
        }
    
        protected function doGetCustomExportOptions(Page $page, $exportType, $rowData, &$options)
        {
    
        }
    
        protected function doFileUpload($fieldName, $rowData, &$result, &$accept, $originalFileName, $originalFileExtension, $fileSize, $tempFileName)
        {
    
        }
    
        protected function doPrepareChart(Chart $chart)
        {
    
        }
    
        protected function doPrepareColumnFilter(ColumnFilter $columnFilter)
        {
    
        }
    
        protected function doPrepareFilterBuilder(FilterBuilder $filterBuilder, FixedKeysArray $columns)
        {
    
        }
    
        protected function doGetSelectionFilters(FixedKeysArray $columns, &$result)
        {
    
        }
    
        protected function doGetCustomFormLayout($mode, FixedKeysArray $columns, FormLayout $layout)
        {
    
        }
    
        protected function doGetCustomColumnGroup(FixedKeysArray $columns, ViewColumnGroup $columnGroup)
        {
    
        }
    
        protected function doPageLoaded()
        {
    
        }
    
        protected function doCalculateFields($rowData, $fieldName, &$value)
        {
    
        }
    
        protected function doGetCustomPagePermissions(Page $page, PermissionSet &$permissions, &$handled)
        {
    
        }
    
        protected function doGetCustomRecordPermissions(Page $page, &$usingCondition, $rowData, &$allowEdit, &$allowDelete, &$mergeWithDefault, &$handled)
        {
    
        }
    
    }

    SetUpUserAuthorization();

    try
    {
        $Page = new employment_categoryPage("employment_category", "employment_category.php", GetCurrentUserPermissionSetForDataSource("employment_category"), 'UTF-8');
        $Page->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource("employment_category"));
        GetApplication()->SetMainPage($Page);
        GetApplication()->Run();
    }
    catch(Exception $e)
    {
        ShowErrorPage($e);
    }
	
