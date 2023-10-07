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

    
    
    class necessary_forms_form_cat_idNestedPage extends NestedFormPage
    {
        protected function DoBeforeCreate()
        {
            $this->dataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`form_category`');
            $this->dataset->addFields(
                array(
                    new IntegerField('form_cat_id', true, true, true),
                    new StringField('form_cat')
                )
            );
        }
    
        protected function DoPrepare() {
    
        }
    
        protected function AddInsertColumns(Grid $grid)
        {
            //
            // Edit column for form_cat field
            //
            $editor = new TextEdit('form_cat_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Form Cat', 'form_cat', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
        }
    
        function GetCustomClientScript()
        {
            return ;
        }
        
        function GetOnPageLoadedClientScript()
        {
            return ;
        }
    
        protected function setClientSideEvents(Grid $grid) {
    
        }
    
        protected function ApplyCommonColumnEditProperties(CustomEditColumn $column)
        {
            $column->SetDisplaySetToNullCheckBox(false);
            $column->SetDisplaySetToDefaultCheckBox(false);
            $column->SetVariableContainer($this->GetColumnVariableContainer());
        }
    
       static public function getNestedInsertHandlerName()
        {
            return get_class() . '_form_insert';
        }
    
        public function GetGridInsertHandler()
        {
            return self::getNestedInsertHandlerName();
        }
    
        protected function doGetCustomTemplate($type, $part, $mode, &$result, &$params)
        {
    
        }
    
        protected function doGetCustomFormLayout($mode, FixedKeysArray $columns, FormLayout $layout)
        {
    
        }
    
        protected function doFileUpload($fieldName, $rowData, &$result, &$accept, $originalFileName, $originalFileExtension, $fileSize, $tempFileName)
        {
    
        }
    
        public function doCustomDefaultValues(&$values, &$handled) 
        {
    
        }
    
        protected function doBeforeInsertRecord($page, &$rowData, $tableName, &$cancel, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doAfterInsertRecord($page, $rowData, $tableName, &$success, &$message, &$messageDisplayTime)
        {
    
        }
    
    }
    
    // OnBeforePageExecute event handler
    
    
    
    class necessary_formsPage extends Page
    {
        protected function DoBeforeCreate()
        {
            $this->SetTitle('Necessary Forms');
            $this->SetMenuLabel('Necessary Forms');
            $this->SetHeader(GetPagesHeader());
            $this->SetFooter(GetPagesFooter());
    
            $this->dataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`necessary_forms`');
            $this->dataset->addFields(
                array(
                    new IntegerField('form_id', true, true, true),
                    new StringField('form_name'),
                    new IntegerField('form_cat_id'),
                    new StringField('form_file')
                )
            );
            $this->dataset->AddLookupField('form_cat_id', 'form_category', new IntegerField('form_cat_id'), new StringField('form_cat', false, false, false, false, 'form_cat_id_form_cat', 'form_cat_id_form_cat_form_category'), 'form_cat_id_form_cat_form_category');
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
                new FilterColumn($this->dataset, 'form_id', 'form_id', 'Form Id'),
                new FilterColumn($this->dataset, 'form_name', 'form_name', 'Form Name'),
                new FilterColumn($this->dataset, 'form_cat_id', 'form_cat_id_form_cat', 'Form Type'),
                new FilterColumn($this->dataset, 'form_file', 'form_file', 'Form File')
            );
        }
    
        protected function setupQuickFilter(QuickFilter $quickFilter, FixedKeysArray $columns)
        {
            $quickFilter
                ->addColumn($columns['form_name'])
                ->addColumn($columns['form_cat_id'])
                ->addColumn($columns['form_file']);
        }
    
        protected function setupColumnFilter(ColumnFilter $columnFilter)
        {
            $columnFilter
                ->setOptionsFor('form_cat_id');
        }
    
        protected function setupFilterBuilder(FilterBuilder $filterBuilder, FixedKeysArray $columns)
        {
            $main_editor = new TextEdit('form_name_edit');
            $main_editor->SetMaxLength(250);
            
            $filterBuilder->addColumn(
                $columns['form_name'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DynamicCombobox('form_cat_id_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_necessary_forms_form_cat_id_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('form_cat_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_necessary_forms_form_cat_id_search');
            
            $filterBuilder->addColumn(
                $columns['form_cat_id'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IN => $multi_value_select_editor,
                    FilterConditionOperator::NOT_IN => $multi_value_select_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('form_file');
            
            $filterBuilder->addColumn(
                $columns['form_file'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
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
            // View column for form_name field
            //
            $column = new TextViewColumn('form_name', 'form_name', 'Form Name', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('necessary_formsGrid_form_name_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for form_cat field
            //
            $column = new TextViewColumn('form_cat_id', 'form_cat_id_form_cat', 'Form Type', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for form_file field
            //
            $column = new DownloadExternalDataColumn('form_file', 'form_file', 'Form File', $this->dataset, '');
            $column->SetOrderable(true);
            $column->setSourcePrefixTemplate('../assets/files/necessary_forms/');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
        }
    
        protected function AddSingleRecordViewColumns(Grid $grid)
        {
            //
            // View column for form_name field
            //
            $column = new TextViewColumn('form_name', 'form_name', 'Form Name', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('necessary_formsGrid_form_name_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for form_cat field
            //
            $column = new TextViewColumn('form_cat_id', 'form_cat_id_form_cat', 'Form Type', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for form_file field
            //
            $column = new DownloadExternalDataColumn('form_file', 'form_file', 'Form File', $this->dataset, '');
            $column->SetOrderable(true);
            $column->setSourcePrefixTemplate('../assets/files/necessary_forms/');
            $grid->AddSingleRecordViewColumn($column);
        }
    
        protected function AddEditColumns(Grid $grid)
        {
            //
            // Edit column for form_name field
            //
            $editor = new TextEdit('form_name_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Form Name', 'form_name', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for form_cat_id field
            //
            $editor = new DynamicCombobox('form_cat_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`form_category`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('form_cat_id', true, true, true),
                    new StringField('form_cat')
                )
            );
            $lookupDataset->setOrderByField('form_cat', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Form Type', 'form_cat_id', 'form_cat_id_form_cat', 'edit_necessary_forms_form_cat_id_search', $editor, $this->dataset, $lookupDataset, 'form_cat_id', 'form_cat', '');
            $editColumn->setNestedInsertFormLink(
                $this->GetHandlerLink(necessary_forms_form_cat_idNestedPage::getNestedInsertHandlerName())
            );
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for form_file field
            //
            $editor = new ImageUploader('form_file_edit');
            $editor->SetShowImage(false);
            $editColumn = new UploadFileToFolderColumn('Form File', 'form_file', $editor, $this->dataset, false, false, '../assets/files/necessary_forms/', '%random%.%original_file_extension%', $this->OnFileUpload, true);
            $editColumn->SetReplaceUploadedFileIfExist(false);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
        }
    
        protected function AddMultiEditColumns(Grid $grid)
        {
            //
            // Edit column for form_name field
            //
            $editor = new TextEdit('form_name_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Form Name', 'form_name', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for form_cat_id field
            //
            $editor = new DynamicCombobox('form_cat_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`form_category`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('form_cat_id', true, true, true),
                    new StringField('form_cat')
                )
            );
            $lookupDataset->setOrderByField('form_cat', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Form Type', 'form_cat_id', 'form_cat_id_form_cat', 'multi_edit_necessary_forms_form_cat_idNestedPage_form_cat_id_search', $editor, $this->dataset, $lookupDataset, 'form_cat_id', 'form_cat', '');
            $editColumn->setNestedInsertFormLink(
                $this->GetHandlerLink(necessary_forms_form_cat_idNestedPage::getNestedInsertHandlerName())
            );
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for form_file field
            //
            $editor = new ImageUploader('form_file_edit');
            $editor->SetShowImage(false);
            $editColumn = new UploadFileToFolderColumn('Form File', 'form_file', $editor, $this->dataset, false, false, '../assets/files/necessary_forms/', '%random%.%original_file_extension%', $this->OnFileUpload, true);
            $editColumn->SetReplaceUploadedFileIfExist(false);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
        }
    
        protected function AddInsertColumns(Grid $grid)
        {
            //
            // Edit column for form_name field
            //
            $editor = new TextEdit('form_name_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Form Name', 'form_name', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for form_cat_id field
            //
            $editor = new DynamicCombobox('form_cat_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`form_category`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('form_cat_id', true, true, true),
                    new StringField('form_cat')
                )
            );
            $lookupDataset->setOrderByField('form_cat', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Form Type', 'form_cat_id', 'form_cat_id_form_cat', 'insert_necessary_forms_form_cat_id_search', $editor, $this->dataset, $lookupDataset, 'form_cat_id', 'form_cat', '');
            $editColumn->setNestedInsertFormLink(
                $this->GetHandlerLink(necessary_forms_form_cat_idNestedPage::getNestedInsertHandlerName())
            );
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for form_file field
            //
            $editor = new ImageUploader('form_file_edit');
            $editor->SetShowImage(false);
            $editColumn = new UploadFileToFolderColumn('Form File', 'form_file', $editor, $this->dataset, false, false, '../assets/files/necessary_forms/', '%random%.%original_file_extension%', $this->OnFileUpload, true);
            $editColumn->SetReplaceUploadedFileIfExist(false);
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
            // View column for form_name field
            //
            $column = new TextViewColumn('form_name', 'form_name', 'Form Name', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('necessary_formsGrid_form_name_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for form_cat field
            //
            $column = new TextViewColumn('form_cat_id', 'form_cat_id_form_cat', 'Form Type', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for form_file field
            //
            $column = new DownloadExternalDataColumn('form_file', 'form_file', 'Form File', $this->dataset, '');
            $column->SetOrderable(true);
            $column->setSourcePrefixTemplate('../assets/files/necessary_forms/');
            $grid->AddPrintColumn($column);
        }
    
        protected function AddExportColumns(Grid $grid)
        {
            //
            // View column for form_name field
            //
            $column = new TextViewColumn('form_name', 'form_name', 'Form Name', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('necessary_formsGrid_form_name_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for form_cat field
            //
            $column = new TextViewColumn('form_cat_id', 'form_cat_id_form_cat', 'Form Type', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for form_file field
            //
            $column = new DownloadExternalDataColumn('form_file', 'form_file', 'Form File', $this->dataset, '');
            $column->SetOrderable(true);
            $column->setSourcePrefixTemplate('../assets/files/necessary_forms/');
            $grid->AddExportColumn($column);
        }
    
        private function AddCompareColumns(Grid $grid)
        {
            //
            // View column for form_name field
            //
            $column = new TextViewColumn('form_name', 'form_name', 'Form Name', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('necessary_formsGrid_form_name_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for form_cat field
            //
            $column = new TextViewColumn('form_cat_id', 'form_cat_id_form_cat', 'Form Type', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for form_file field
            //
            $column = new DownloadExternalDataColumn('form_file', 'form_file', 'Form File', $this->dataset, '');
            $column->SetOrderable(true);
            $column->setSourcePrefixTemplate('../assets/files/necessary_forms/');
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
            $result->SetViewMode(ViewMode::TABLE);
            $result->setEnableRuntimeCustomization(false);
            $result->setMultiEditAllowed($this->GetSecurityInfo()->HasEditGrant() && true);
            $result->setIncludeAllFieldsForMultiEditByDefault(false);
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
            $this->setPrintListAvailable(true);
            $this->setPrintListRecordAvailable(true);
            $this->setPrintOneRecordAvailable(false);
            $this->setAllowPrintSelectedRecords(false);
            $this->setExportListAvailable(array('pdf', 'excel'));
            $this->setExportSelectedRecordsAvailable(array());
            $this->setExportListRecordAvailable(array('pdf', 'excel'));
            $this->setExportOneRecordAvailable(array());
    
            return $result;
        }
     
        protected function setClientSideEvents(Grid $grid) {
    
        }
    
        protected function doRegisterHandlers() {
            //
            // View column for form_name field
            //
            $column = new TextViewColumn('form_name', 'form_name', 'Form Name', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'necessary_formsGrid_form_name_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for form_name field
            //
            $column = new TextViewColumn('form_name', 'form_name', 'Form Name', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'necessary_formsGrid_form_name_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for form_name field
            //
            $column = new TextViewColumn('form_name', 'form_name', 'Form Name', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'necessary_formsGrid_form_name_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`form_category`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('form_cat_id', true, true, true),
                    new StringField('form_cat')
                )
            );
            $lookupDataset->setOrderByField('form_cat', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_necessary_forms_form_cat_id_search', 'form_cat_id', 'form_cat', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`form_category`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('form_cat_id', true, true, true),
                    new StringField('form_cat')
                )
            );
            $lookupDataset->setOrderByField('form_cat', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_necessary_forms_form_cat_id_search', 'form_cat_id', 'form_cat', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`form_category`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('form_cat_id', true, true, true),
                    new StringField('form_cat')
                )
            );
            $lookupDataset->setOrderByField('form_cat', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_necessary_forms_form_cat_id_search', 'form_cat_id', 'form_cat', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for form_name field
            //
            $column = new TextViewColumn('form_name', 'form_name', 'Form Name', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'necessary_formsGrid_form_name_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`form_category`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('form_cat_id', true, true, true),
                    new StringField('form_cat')
                )
            );
            $lookupDataset->setOrderByField('form_cat', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_necessary_forms_form_cat_id_search', 'form_cat_id', 'form_cat', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`form_category`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('form_cat_id', true, true, true),
                    new StringField('form_cat')
                )
            );
            $lookupDataset->setOrderByField('form_cat', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_necessary_forms_form_cat_idNestedPage_form_cat_id_search', 'form_cat_id', 'form_cat', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            
            
            new necessary_forms_form_cat_idNestedPage($this, GetCurrentUserPermissionSetForDataSource('necessary_forms.form_cat_id'));
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
        $Page = new necessary_formsPage("necessary_forms", "necessary_forms.php", GetCurrentUserPermissionSetForDataSource("necessary_forms"), 'UTF-8');
        $Page->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource("necessary_forms"));
        GetApplication()->SetMainPage($Page);
        GetApplication()->Run();
    }
    catch(Exception $e)
    {
        ShowErrorPage($e);
    }
	
