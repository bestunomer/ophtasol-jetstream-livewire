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
    
    
    
    class doctor_staff_contractsPage extends DetailPage
    {
        protected function DoBeforeCreate()
        {
            $this->SetTitle('Staff Contracts');
            $this->SetMenuLabel('Staff Contracts');
            $this->SetHeader(GetPagesHeader());
            $this->SetFooter(GetPagesFooter());
    
            $this->dataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`staff_contracts`');
            $this->dataset->addFields(
                array(
                    new IntegerField('contract_id', true, true, true),
                    new IntegerField('doctor_id'),
                    new DateField('contract_start_date'),
                    new DateField('contract_end_date'),
                    new IntegerField('job_title_id'),
                    new StringField('contract_file')
                )
            );
            $this->dataset->AddLookupField('job_title_id', 'job_title', new IntegerField('job_title_id'), new StringField('job_title_e', false, false, false, false, 'job_title_id_job_title_e', 'job_title_id_job_title_e_job_title'), 'job_title_id_job_title_e_job_title');
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
                new FilterColumn($this->dataset, 'contract_id', 'contract_id', 'Contract Id'),
                new FilterColumn($this->dataset, 'doctor_id', 'doctor_id', 'Doctor Id'),
                new FilterColumn($this->dataset, 'contract_start_date', 'contract_start_date', 'Contract Start Date'),
                new FilterColumn($this->dataset, 'contract_end_date', 'contract_end_date', 'Contract End Date'),
                new FilterColumn($this->dataset, 'job_title_id', 'job_title_id_job_title_e', 'Job Title'),
                new FilterColumn($this->dataset, 'contract_file', 'contract_file', 'Contract File')
            );
        }
    
        protected function setupQuickFilter(QuickFilter $quickFilter, FixedKeysArray $columns)
        {
            $quickFilter
                ->addColumn($columns['contract_start_date'])
                ->addColumn($columns['contract_end_date'])
                ->addColumn($columns['job_title_id'])
                ->addColumn($columns['contract_file']);
        }
    
        protected function setupColumnFilter(ColumnFilter $columnFilter)
        {
            $columnFilter
                ->setOptionsFor('contract_start_date')
                ->setOptionsFor('contract_end_date')
                ->setOptionsFor('job_title_id');
        }
    
        protected function setupFilterBuilder(FilterBuilder $filterBuilder, FixedKeysArray $columns)
        {
            $main_editor = new DateTimeEdit('contract_start_date_edit', false, 'd M y');
            
            $filterBuilder->addColumn(
                $columns['contract_start_date'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::DATE_EQUALS => $main_editor,
                    FilterConditionOperator::DATE_DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::TODAY => null,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DateTimeEdit('contract_end_date_edit', false, 'd M y');
            
            $filterBuilder->addColumn(
                $columns['contract_end_date'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::DATE_EQUALS => $main_editor,
                    FilterConditionOperator::DATE_DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::TODAY => null,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DynamicCombobox('job_title_id_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_doctor_staff_contracts_job_title_id_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('job_title_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_doctor_staff_contracts_job_title_id_search');
            
            $filterBuilder->addColumn(
                $columns['job_title_id'],
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
            
            $main_editor = new TextEdit('contract_file');
            
            $filterBuilder->addColumn(
                $columns['contract_file'],
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
            // View column for contract_start_date field
            //
            $column = new DateTimeViewColumn('contract_start_date', 'contract_start_date', 'Contract Start Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d M y');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for contract_end_date field
            //
            $column = new DateTimeViewColumn('contract_end_date', 'contract_end_date', 'Contract End Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d M y');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for job_title_e field
            //
            $column = new TextViewColumn('job_title_id', 'job_title_id_job_title_e', 'Job Title', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for contract_file field
            //
            $column = new DownloadExternalDataColumn('contract_file', 'contract_file', 'Contract File', $this->dataset, '');
            $column->SetOrderable(true);
            $column->setSourcePrefixTemplate('../assets/files/contract_files/%doctor_id%/');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
        }
    
        protected function AddSingleRecordViewColumns(Grid $grid)
        {
            //
            // View column for contract_start_date field
            //
            $column = new DateTimeViewColumn('contract_start_date', 'contract_start_date', 'Contract Start Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d M y');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for contract_end_date field
            //
            $column = new DateTimeViewColumn('contract_end_date', 'contract_end_date', 'Contract End Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d M y');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for job_title_e field
            //
            $column = new TextViewColumn('job_title_id', 'job_title_id_job_title_e', 'Job Title', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for contract_file field
            //
            $column = new DownloadExternalDataColumn('contract_file', 'contract_file', 'Contract File', $this->dataset, '');
            $column->SetOrderable(true);
            $column->setSourcePrefixTemplate('../assets/files/contract_files/%doctor_id%/');
            $grid->AddSingleRecordViewColumn($column);
        }
    
        protected function AddEditColumns(Grid $grid)
        {
            //
            // Edit column for contract_start_date field
            //
            $editor = new DateTimeEdit('contract_start_date_edit', false, 'd M y');
            $editColumn = new CustomEditColumn('Contract Start Date', 'contract_start_date', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for contract_end_date field
            //
            $editor = new DateTimeEdit('contract_end_date_edit', false, 'd M y');
            $editColumn = new CustomEditColumn('Contract End Date', 'contract_end_date', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for job_title_id field
            //
            $editor = new DynamicCombobox('job_title_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`job_title`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('job_title_id', true, true, true),
                    new StringField('job_title_k'),
                    new StringField('job_title_ar'),
                    new StringField('job_title_e')
                )
            );
            $lookupDataset->setOrderByField('job_title_e', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Job Title', 'job_title_id', 'job_title_id_job_title_e', 'edit_doctor_staff_contracts_job_title_id_search', $editor, $this->dataset, $lookupDataset, 'job_title_id', 'job_title_e', '');
            $editColumn->setNestedInsertFormLink(
                $this->GetHandlerLink(doctor_staff_contracts_job_title_idNestedPage::getNestedInsertHandlerName())
            );
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for contract_file field
            //
            $editor = new ImageUploader('contract_file_edit');
            $editor->SetShowImage(false);
            $editColumn = new UploadFileToFolderColumn('Contract File', 'contract_file', $editor, $this->dataset, false, false, '../assets/files/contract_files/%doctor_id%/', '%random%.%original_file_extension%', $this->OnFileUpload, true);
            $editColumn->SetReplaceUploadedFileIfExist(false);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
        }
    
        protected function AddMultiEditColumns(Grid $grid)
        {
            //
            // Edit column for contract_start_date field
            //
            $editor = new DateTimeEdit('contract_start_date_edit', false, 'd M y');
            $editColumn = new CustomEditColumn('Contract Start Date', 'contract_start_date', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for contract_end_date field
            //
            $editor = new DateTimeEdit('contract_end_date_edit', false, 'd M y');
            $editColumn = new CustomEditColumn('Contract End Date', 'contract_end_date', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for job_title_id field
            //
            $editor = new DynamicCombobox('job_title_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`job_title`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('job_title_id', true, true, true),
                    new StringField('job_title_k'),
                    new StringField('job_title_ar'),
                    new StringField('job_title_e')
                )
            );
            $lookupDataset->setOrderByField('job_title_e', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Job Title', 'job_title_id', 'job_title_id_job_title_e', 'multi_edit_doctor_staff_contracts_job_title_idNestedPage_job_title_id_search', $editor, $this->dataset, $lookupDataset, 'job_title_id', 'job_title_e', '');
            $editColumn->setNestedInsertFormLink(
                $this->GetHandlerLink(doctor_staff_contracts_job_title_idNestedPage::getNestedInsertHandlerName())
            );
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for contract_file field
            //
            $editor = new ImageUploader('contract_file_edit');
            $editor->SetShowImage(false);
            $editColumn = new UploadFileToFolderColumn('Contract File', 'contract_file', $editor, $this->dataset, false, false, '../assets/files/contract_files/%doctor_id%/', '%random%.%original_file_extension%', $this->OnFileUpload, true);
            $editColumn->SetReplaceUploadedFileIfExist(false);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
        }
    
        protected function AddInsertColumns(Grid $grid)
        {
            //
            // Edit column for contract_start_date field
            //
            $editor = new DateTimeEdit('contract_start_date_edit', false, 'd M y');
            $editColumn = new CustomEditColumn('Contract Start Date', 'contract_start_date', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for contract_end_date field
            //
            $editor = new DateTimeEdit('contract_end_date_edit', false, 'd M y');
            $editColumn = new CustomEditColumn('Contract End Date', 'contract_end_date', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for job_title_id field
            //
            $editor = new DynamicCombobox('job_title_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`job_title`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('job_title_id', true, true, true),
                    new StringField('job_title_k'),
                    new StringField('job_title_ar'),
                    new StringField('job_title_e')
                )
            );
            $lookupDataset->setOrderByField('job_title_e', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Job Title', 'job_title_id', 'job_title_id_job_title_e', 'insert_doctor_staff_contracts_job_title_id_search', $editor, $this->dataset, $lookupDataset, 'job_title_id', 'job_title_e', '');
            $editColumn->setNestedInsertFormLink(
                $this->GetHandlerLink(doctor_staff_contracts_job_title_idNestedPage::getNestedInsertHandlerName())
            );
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for contract_file field
            //
            $editor = new ImageUploader('contract_file_edit');
            $editor->SetShowImage(false);
            $editColumn = new UploadFileToFolderColumn('Contract File', 'contract_file', $editor, $this->dataset, false, false, '../assets/files/contract_files/%doctor_id%/', '%random%.%original_file_extension%', $this->OnFileUpload, true);
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
            // View column for contract_start_date field
            //
            $column = new DateTimeViewColumn('contract_start_date', 'contract_start_date', 'Contract Start Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d M y');
            $grid->AddPrintColumn($column);
            
            //
            // View column for contract_end_date field
            //
            $column = new DateTimeViewColumn('contract_end_date', 'contract_end_date', 'Contract End Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d M y');
            $grid->AddPrintColumn($column);
            
            //
            // View column for job_title_e field
            //
            $column = new TextViewColumn('job_title_id', 'job_title_id_job_title_e', 'Job Title', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for contract_file field
            //
            $column = new DownloadExternalDataColumn('contract_file', 'contract_file', 'Contract File', $this->dataset, '');
            $column->SetOrderable(true);
            $column->setSourcePrefixTemplate('../assets/files/contract_files/%doctor_id%/');
            $grid->AddPrintColumn($column);
        }
    
        protected function AddExportColumns(Grid $grid)
        {
            //
            // View column for contract_start_date field
            //
            $column = new DateTimeViewColumn('contract_start_date', 'contract_start_date', 'Contract Start Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d M y');
            $grid->AddExportColumn($column);
            
            //
            // View column for contract_end_date field
            //
            $column = new DateTimeViewColumn('contract_end_date', 'contract_end_date', 'Contract End Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d M y');
            $grid->AddExportColumn($column);
            
            //
            // View column for job_title_e field
            //
            $column = new TextViewColumn('job_title_id', 'job_title_id_job_title_e', 'Job Title', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for contract_file field
            //
            $column = new DownloadExternalDataColumn('contract_file', 'contract_file', 'Contract File', $this->dataset, '');
            $column->SetOrderable(true);
            $column->setSourcePrefixTemplate('../assets/files/contract_files/%doctor_id%/');
            $grid->AddExportColumn($column);
        }
    
        private function AddCompareColumns(Grid $grid)
        {
            //
            // View column for contract_start_date field
            //
            $column = new DateTimeViewColumn('contract_start_date', 'contract_start_date', 'Contract Start Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d M y');
            $grid->AddCompareColumn($column);
            
            //
            // View column for contract_end_date field
            //
            $column = new DateTimeViewColumn('contract_end_date', 'contract_end_date', 'Contract End Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d M y');
            $grid->AddCompareColumn($column);
            
            //
            // View column for job_title_e field
            //
            $column = new TextViewColumn('job_title_id', 'job_title_id_job_title_e', 'Job Title', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for contract_file field
            //
            $column = new DownloadExternalDataColumn('contract_file', 'contract_file', 'Contract File', $this->dataset, '');
            $column->SetOrderable(true);
            $column->setSourcePrefixTemplate('../assets/files/contract_files/%doctor_id%/');
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
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`job_title`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('job_title_id', true, true, true),
                    new StringField('job_title_k'),
                    new StringField('job_title_ar'),
                    new StringField('job_title_e')
                )
            );
            $lookupDataset->setOrderByField('job_title_e', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_doctor_staff_contracts_job_title_id_search', 'job_title_id', 'job_title_e', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`job_title`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('job_title_id', true, true, true),
                    new StringField('job_title_k'),
                    new StringField('job_title_ar'),
                    new StringField('job_title_e')
                )
            );
            $lookupDataset->setOrderByField('job_title_e', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_doctor_staff_contracts_job_title_id_search', 'job_title_id', 'job_title_e', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`job_title`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('job_title_id', true, true, true),
                    new StringField('job_title_k'),
                    new StringField('job_title_ar'),
                    new StringField('job_title_e')
                )
            );
            $lookupDataset->setOrderByField('job_title_e', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_doctor_staff_contracts_job_title_id_search', 'job_title_id', 'job_title_e', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`job_title`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('job_title_id', true, true, true),
                    new StringField('job_title_k'),
                    new StringField('job_title_ar'),
                    new StringField('job_title_e')
                )
            );
            $lookupDataset->setOrderByField('job_title_e', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_doctor_staff_contracts_job_title_id_search', 'job_title_id', 'job_title_e', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`job_title`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('job_title_id', true, true, true),
                    new StringField('job_title_k'),
                    new StringField('job_title_ar'),
                    new StringField('job_title_e')
                )
            );
            $lookupDataset->setOrderByField('job_title_e', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_doctor_staff_contracts_job_title_idNestedPage_job_title_id_search', 'job_title_id', 'job_title_e', null, 20);
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
    
    class doctor_staff_contracts_job_title_idNestedPage extends NestedFormPage
    {
        protected function DoBeforeCreate()
        {
            $this->dataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`job_title`');
            $this->dataset->addFields(
                array(
                    new IntegerField('job_title_id', true, true, true),
                    new StringField('job_title_k'),
                    new StringField('job_title_ar'),
                    new StringField('job_title_e')
                )
            );
        }
    
        protected function DoPrepare() {
    
        }
    
        protected function AddInsertColumns(Grid $grid)
        {
            //
            // Edit column for job_title_k field
            //
            $editor = new TextEdit('job_title_k_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Job Title K', 'job_title_k', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for job_title_ar field
            //
            $editor = new TextEdit('job_title_ar_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Job Title Ar', 'job_title_ar', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for job_title_e field
            //
            $editor = new TextEdit('job_title_e_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Job Title E', 'job_title_e', $editor, $this->dataset);
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
    
    class doctor_doctor_cat_idNestedPage extends NestedFormPage
    {
        protected function DoBeforeCreate()
        {
            $this->dataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`doctor_cat`');
            $this->dataset->addFields(
                array(
                    new IntegerField('doctor_cat_id', true, true, true),
                    new StringField('doctor_cat'),
                    new StringField('doctor_cat_K', true),
                    new StringField('doctor_cat_A', true),
                    new IntegerField('publish_id')
                )
            );
        }
    
        protected function DoPrepare() {
    
        }
    
        protected function AddInsertColumns(Grid $grid)
        {
            //
            // Edit column for doctor_cat field
            //
            $editor = new TextEdit('doctor_cat_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Doctor Cat', 'doctor_cat', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for publish_id field
            //
            $editor = new TextEdit('publish_id_edit');
            $editColumn = new CustomEditColumn('Publish Id', 'publish_id', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for doctor_cat_K field
            //
            $editor = new TextEdit('doctor_cat_k_edit');
            $editor->SetMaxLength(50);
            $editColumn = new CustomEditColumn('Doctor Cat K', 'doctor_cat_K', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for doctor_cat_A field
            //
            $editor = new TextEdit('doctor_cat_a_edit');
            $editor->SetMaxLength(50);
            $editColumn = new CustomEditColumn('Doctor Cat A', 'doctor_cat_A', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
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
    
    class doctor_job_title_idNestedPage extends NestedFormPage
    {
        protected function DoBeforeCreate()
        {
            $this->dataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`job_title`');
            $this->dataset->addFields(
                array(
                    new IntegerField('job_title_id', true, true, true),
                    new StringField('job_title_k'),
                    new StringField('job_title_ar'),
                    new StringField('job_title_e')
                )
            );
        }
    
        protected function DoPrepare() {
    
        }
    
        protected function AddInsertColumns(Grid $grid)
        {
            //
            // Edit column for job_title_k field
            //
            $editor = new TextEdit('job_title_k_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Job Title K', 'job_title_k', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for job_title_ar field
            //
            $editor = new TextEdit('job_title_ar_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Job Title Ar', 'job_title_ar', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for job_title_e field
            //
            $editor = new TextEdit('job_title_e_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Job Title E', 'job_title_e', $editor, $this->dataset);
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
    
    class doctor_employment_cat_idNestedPage extends NestedFormPage
    {
        protected function DoBeforeCreate()
        {
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
    
    
    
    class doctorPage extends Page
    {
        protected function DoBeforeCreate()
        {
            $this->SetTitle('All Staff');
            $this->SetMenuLabel('All Staff');
            $this->SetHeader(GetPagesHeader());
            $this->SetFooter(GetPagesFooter());
    
            $this->dataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`doctor`');
            $this->dataset->addFields(
                array(
                    new IntegerField('doctor_id', true, true, true),
                    new IntegerField('doctor_cat_id'),
                    new StringField('fullname'),
                    new StringField('fullname_k'),
                    new StringField('fullname_a'),
                    new StringField('qualification', true),
                    new StringField('qualification_k'),
                    new StringField('qualification_a'),
                    new StringField('detail_about_doctor'),
                    new StringField('detail_about_doctor_k'),
                    new StringField('detail_about_doctor_a'),
                    new StringField('work_email', true),
                    new StringField('personal_email'),
                    new StringField('mobile'),
                    new StringField('work_mobile'),
                    new StringField('working_hours'),
                    new StringField('working_hours_k'),
                    new StringField('working_hours_a'),
                    new StringField('doctor_photo'),
                    new StringField('diploma_id_card'),
                    new StringField('video_link'),
                    new StringField('account_password'),
                    new IntegerField('active', true),
                    new StringField('clinic_address_k'),
                    new StringField('clinic_address_a'),
                    new StringField('clinic_address'),
                    new StringField('clinic_mobile'),
                    new IntegerField('job_title_id'),
                    new DateField('first_employment_date'),
                    new IntegerField('salary_amount'),
                    new DateField('date_of_birth'),
                    new StringField('home_address'),
                    new IntegerField('employment_cat_id'),
                    new IntegerField('support_letter_download_counter')
                )
            );
            $this->dataset->AddLookupField('doctor_cat_id', 'doctor_cat', new IntegerField('doctor_cat_id'), new StringField('doctor_cat', false, false, false, false, 'doctor_cat_id_doctor_cat', 'doctor_cat_id_doctor_cat_doctor_cat'), 'doctor_cat_id_doctor_cat_doctor_cat');
            $this->dataset->AddLookupField('job_title_id', 'job_title', new IntegerField('job_title_id'), new StringField('job_title_e', false, false, false, false, 'job_title_id_job_title_e', 'job_title_id_job_title_e_job_title'), 'job_title_id_job_title_e_job_title');
            $this->dataset->AddLookupField('employment_cat_id', 'employment_category', new IntegerField('employment_cat_id'), new StringField('employment_cat_e', false, false, false, false, 'employment_cat_id_employment_cat_e', 'employment_cat_id_employment_cat_e_employment_category'), 'employment_cat_id_employment_cat_e_employment_category');
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
                new FilterColumn($this->dataset, 'doctor_id', 'doctor_id', 'Doctor Id'),
                new FilterColumn($this->dataset, 'doctor_photo', 'doctor_photo', 'Doctor Photo(800x600)'),
                new FilterColumn($this->dataset, 'fullname', 'fullname', 'Full name'),
                new FilterColumn($this->dataset, 'fullname_k', 'fullname_k', 'Fullname K'),
                new FilterColumn($this->dataset, 'fullname_a', 'fullname_a', 'Fullname A'),
                new FilterColumn($this->dataset, 'qualification', 'qualification', 'Qualifications'),
                new FilterColumn($this->dataset, 'qualification_a', 'qualification_a', 'Qualification A'),
                new FilterColumn($this->dataset, 'qualification_k', 'qualification_k', 'Qualification K'),
                new FilterColumn($this->dataset, 'doctor_cat_id', 'doctor_cat_id_doctor_cat', 'Staff Type'),
                new FilterColumn($this->dataset, 'work_email', 'work_email', 'Work Email'),
                new FilterColumn($this->dataset, 'personal_email', 'personal_email', 'Personal Email'),
                new FilterColumn($this->dataset, 'mobile', 'mobile', 'Mobile'),
                new FilterColumn($this->dataset, 'work_mobile', 'work_mobile', 'Work Mobile'),
                new FilterColumn($this->dataset, 'detail_about_doctor', 'detail_about_doctor', 'Detail About Doctor'),
                new FilterColumn($this->dataset, 'detail_about_doctor_k', 'detail_about_doctor_k', 'Detail About Doctor K'),
                new FilterColumn($this->dataset, 'detail_about_doctor_a', 'detail_about_doctor_a', 'Detail About Doctor A'),
                new FilterColumn($this->dataset, 'working_hours', 'working_hours', 'Working Hours'),
                new FilterColumn($this->dataset, 'working_hours_k', 'working_hours_k', 'Working Hours K'),
                new FilterColumn($this->dataset, 'working_hours_a', 'working_hours_a', 'Working Hours A'),
                new FilterColumn($this->dataset, 'video_link', 'video_link', 'Video Link'),
                new FilterColumn($this->dataset, 'account_password', 'account_password', 'Account Password'),
                new FilterColumn($this->dataset, 'active', 'active', 'Active'),
                new FilterColumn($this->dataset, 'clinic_address', 'clinic_address', 'Clinic Address'),
                new FilterColumn($this->dataset, 'clinic_address_k', 'clinic_address_k', 'Clinic Address K'),
                new FilterColumn($this->dataset, 'clinic_address_a', 'clinic_address_a', 'Clinic Address A'),
                new FilterColumn($this->dataset, 'clinic_mobile', 'clinic_mobile', 'Clinic Mobile'),
                new FilterColumn($this->dataset, 'diploma_id_card', 'diploma_id_card', 'Diploma Id Card'),
                new FilterColumn($this->dataset, 'job_title_id', 'job_title_id_job_title_e', 'Job Title'),
                new FilterColumn($this->dataset, 'first_employment_date', 'first_employment_date', 'First Employment Date'),
                new FilterColumn($this->dataset, 'salary_amount', 'salary_amount', 'Salary Amount'),
                new FilterColumn($this->dataset, 'date_of_birth', 'date_of_birth', 'Date Of Birth'),
                new FilterColumn($this->dataset, 'home_address', 'home_address', 'Home Address'),
                new FilterColumn($this->dataset, 'employment_cat_id', 'employment_cat_id_employment_cat_e', 'Employment Category'),
                new FilterColumn($this->dataset, 'support_letter_download_counter', 'support_letter_download_counter', 'Support Letter Download Counter')
            );
        }
    
        protected function setupQuickFilter(QuickFilter $quickFilter, FixedKeysArray $columns)
        {
            $quickFilter
                ->addColumn($columns['doctor_photo'])
                ->addColumn($columns['fullname'])
                ->addColumn($columns['fullname_k'])
                ->addColumn($columns['fullname_a'])
                ->addColumn($columns['qualification'])
                ->addColumn($columns['qualification_a'])
                ->addColumn($columns['qualification_k'])
                ->addColumn($columns['doctor_cat_id'])
                ->addColumn($columns['work_email'])
                ->addColumn($columns['personal_email'])
                ->addColumn($columns['mobile'])
                ->addColumn($columns['work_mobile'])
                ->addColumn($columns['working_hours'])
                ->addColumn($columns['working_hours_k'])
                ->addColumn($columns['working_hours_a'])
                ->addColumn($columns['active'])
                ->addColumn($columns['clinic_address'])
                ->addColumn($columns['clinic_address_k'])
                ->addColumn($columns['clinic_address_a'])
                ->addColumn($columns['clinic_mobile'])
                ->addColumn($columns['diploma_id_card'])
                ->addColumn($columns['job_title_id'])
                ->addColumn($columns['first_employment_date'])
                ->addColumn($columns['salary_amount'])
                ->addColumn($columns['date_of_birth'])
                ->addColumn($columns['home_address'])
                ->addColumn($columns['employment_cat_id'])
                ->addColumn($columns['support_letter_download_counter']);
        }
    
        protected function setupColumnFilter(ColumnFilter $columnFilter)
        {
            $columnFilter
                ->setOptionsFor('doctor_cat_id')
                ->setOptionsFor('active')
                ->setOptionsFor('job_title_id')
                ->setOptionsFor('first_employment_date')
                ->setOptionsFor('date_of_birth')
                ->setOptionsFor('employment_cat_id');
        }
    
        protected function setupFilterBuilder(FilterBuilder $filterBuilder, FixedKeysArray $columns)
        {
            $main_editor = new TextEdit('doctor_photo');
            
            $filterBuilder->addColumn(
                $columns['doctor_photo'],
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
            
            $main_editor = new TextEdit('fullname_edit');
            $main_editor->SetMaxLength(250);
            
            $filterBuilder->addColumn(
                $columns['fullname'],
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
            
            $main_editor = new TextEdit('fullname_k_edit');
            $main_editor->SetMaxLength(250);
            
            $filterBuilder->addColumn(
                $columns['fullname_k'],
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
            
            $main_editor = new TextEdit('fullname_a_edit');
            $main_editor->SetMaxLength(250);
            
            $filterBuilder->addColumn(
                $columns['fullname_a'],
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
            
            $main_editor = new TextEdit('qualification_edit');
            $main_editor->SetMaxLength(250);
            
            $filterBuilder->addColumn(
                $columns['qualification'],
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
            
            $main_editor = new TextEdit('qualification_a_edit');
            $main_editor->SetMaxLength(250);
            
            $filterBuilder->addColumn(
                $columns['qualification_a'],
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
            
            $main_editor = new TextEdit('qualification_k_edit');
            $main_editor->SetMaxLength(250);
            
            $filterBuilder->addColumn(
                $columns['qualification_k'],
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
            
            $main_editor = new DynamicCombobox('doctor_cat_id_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_doctor_staff_contracts_job_title_idNestedPage_doctor_cat_id_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('doctor_cat_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_doctor_staff_contracts_job_title_idNestedPage_doctor_cat_id_search');
            
            $text_editor = new TextEdit('doctor_cat_id');
            
            $filterBuilder->addColumn(
                $columns['doctor_cat_id'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $text_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $text_editor,
                    FilterConditionOperator::BEGINS_WITH => $text_editor,
                    FilterConditionOperator::ENDS_WITH => $text_editor,
                    FilterConditionOperator::IS_LIKE => $text_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $text_editor,
                    FilterConditionOperator::IN => $multi_value_select_editor,
                    FilterConditionOperator::NOT_IN => $multi_value_select_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('work_email_edit');
            $main_editor->SetMaxLength(250);
            
            $filterBuilder->addColumn(
                $columns['work_email'],
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
            
            $main_editor = new TextEdit('personal_email_edit');
            $main_editor->SetMaxLength(250);
            
            $filterBuilder->addColumn(
                $columns['personal_email'],
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
            
            $main_editor = new TextEdit('mobile_edit');
            $main_editor->SetMaxLength(250);
            
            $filterBuilder->addColumn(
                $columns['mobile'],
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
            
            $main_editor = new TextEdit('work_mobile_edit');
            $main_editor->SetMaxLength(250);
            
            $filterBuilder->addColumn(
                $columns['work_mobile'],
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
            
            $main_editor = new TextEdit('working_hours_edit');
            $main_editor->SetMaxLength(250);
            
            $filterBuilder->addColumn(
                $columns['working_hours'],
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
            
            $main_editor = new TextEdit('working_hours_k_edit');
            $main_editor->SetMaxLength(250);
            
            $filterBuilder->addColumn(
                $columns['working_hours_k'],
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
            
            $main_editor = new TextEdit('working_hours_a_edit');
            $main_editor->SetMaxLength(250);
            
            $filterBuilder->addColumn(
                $columns['working_hours_a'],
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
            
            $main_editor = new ComboBox('active');
            $main_editor->SetAllowNullValue(false);
            $main_editor->addChoice('1', 'Yes');
            $main_editor->addChoice('0', 'No');
            
            $multi_value_select_editor = new MultiValueSelect('active');
            $multi_value_select_editor->setChoices($main_editor->getChoices());
            
            $filterBuilder->addColumn(
                $columns['active'],
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
            
            $main_editor = new TextEdit('clinic_address_edit');
            $main_editor->SetMaxLength(250);
            
            $filterBuilder->addColumn(
                $columns['clinic_address'],
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
            
            $main_editor = new TextEdit('clinic_address_k_edit');
            $main_editor->SetMaxLength(250);
            
            $filterBuilder->addColumn(
                $columns['clinic_address_k'],
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
            
            $main_editor = new TextEdit('clinic_address_a_edit');
            $main_editor->SetMaxLength(250);
            
            $filterBuilder->addColumn(
                $columns['clinic_address_a'],
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
            
            $main_editor = new TextEdit('clinic_mobile_edit');
            $main_editor->SetMaxLength(250);
            
            $filterBuilder->addColumn(
                $columns['clinic_mobile'],
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
            
            $main_editor = new TextEdit('diploma_id_card_edit');
            $main_editor->SetMaxLength(250);
            
            $filterBuilder->addColumn(
                $columns['diploma_id_card'],
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
            
            $main_editor = new DynamicCombobox('job_title_id_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_doctor_staff_contracts_job_title_idNestedPage_job_title_id_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('job_title_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_doctor_staff_contracts_job_title_idNestedPage_job_title_id_search');
            
            $filterBuilder->addColumn(
                $columns['job_title_id'],
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
            
            $main_editor = new DateTimeEdit('first_employment_date_edit', false, 'd M y');
            
            $filterBuilder->addColumn(
                $columns['first_employment_date'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::DATE_EQUALS => $main_editor,
                    FilterConditionOperator::DATE_DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::TODAY => null,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('salary_amount_edit');
            
            $filterBuilder->addColumn(
                $columns['salary_amount'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DateTimeEdit('date_of_birth_edit', false, 'd M y');
            
            $filterBuilder->addColumn(
                $columns['date_of_birth'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::DATE_EQUALS => $main_editor,
                    FilterConditionOperator::DATE_DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::TODAY => null,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('home_address_edit');
            $main_editor->SetMaxLength(250);
            
            $filterBuilder->addColumn(
                $columns['home_address'],
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
            
            $main_editor = new DynamicCombobox('employment_cat_id_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_doctor_staff_contracts_job_title_idNestedPage_employment_cat_id_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('employment_cat_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_doctor_staff_contracts_job_title_idNestedPage_employment_cat_id_search');
            
            $filterBuilder->addColumn(
                $columns['employment_cat_id'],
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
            
            $main_editor = new TextEdit('support_letter_download_counter_edit');
            
            $filterBuilder->addColumn(
                $columns['support_letter_download_counter'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
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
            if (GetCurrentUserPermissionSetForDataSource('doctor.staff_contracts')->HasViewGrant() && $withDetails)
            {
            //
            // View column for doctor_staff_contracts detail
            //
            $column = new DetailColumn(array('doctor_id'), 'doctor.staff_contracts', 'doctor_staff_contracts_handler', $this->dataset, 'Staff Contracts');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            }
            
            //
            // View column for doctor_photo field
            //
            $column = new ExternalImageViewColumn('doctor_photo', 'doctor_photo', 'Doctor Photo(800x600)', $this->dataset);
            $column->SetOrderable(true);
            $column->setSourcePrefixTemplate('../assets/img/doctors/');
            $column->setWidth('150px');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for fullname field
            //
            $column = new TextViewColumn('fullname', 'fullname', 'Full name', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_fullname_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for doctor_cat field
            //
            $column = new TextViewColumn('doctor_cat_id', 'doctor_cat_id_doctor_cat', 'Staff Type', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_doctor_cat_id_doctor_cat_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for work_email field
            //
            $column = new TextViewColumn('work_email', 'work_email', 'Work Email', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_work_email_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for mobile field
            //
            $column = new TextViewColumn('mobile', 'mobile', 'Mobile', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_mobile_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for work_mobile field
            //
            $column = new TextViewColumn('work_mobile', 'work_mobile', 'Work Mobile', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_work_mobile_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for active field
            //
            $column = new NumberViewColumn('active', 'active', 'Active', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for clinic_mobile field
            //
            $column = new TextViewColumn('clinic_mobile', 'clinic_mobile', 'Clinic Mobile', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_clinic_mobile_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for job_title_e field
            //
            $column = new TextViewColumn('job_title_id', 'job_title_id_job_title_e', 'Job Title', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for first_employment_date field
            //
            $column = new DateTimeViewColumn('first_employment_date', 'first_employment_date', 'First Employment Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d M y');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for salary_amount field
            //
            $column = new NumberViewColumn('salary_amount', 'salary_amount', 'Salary Amount', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for date_of_birth field
            //
            $column = new DateTimeViewColumn('date_of_birth', 'date_of_birth', 'Date Of Birth', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d M y');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for employment_cat_e field
            //
            $column = new TextViewColumn('employment_cat_id', 'employment_cat_id_employment_cat_e', 'Employment Category', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for support_letter_download_counter field
            //
            $column = new NumberViewColumn('support_letter_download_counter', 'support_letter_download_counter', 'Support Letter Download Counter', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
        }
    
        protected function AddSingleRecordViewColumns(Grid $grid)
        {
            //
            // View column for doctor_photo field
            //
            $column = new ExternalImageViewColumn('doctor_photo', 'doctor_photo', 'Doctor Photo(800x600)', $this->dataset);
            $column->SetOrderable(true);
            $column->setSourcePrefixTemplate('../assets/img/doctors/');
            $column->setWidth('150px');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for fullname field
            //
            $column = new TextViewColumn('fullname', 'fullname', 'Full name', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_fullname_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for fullname_k field
            //
            $column = new TextViewColumn('fullname_k', 'fullname_k', 'Fullname K', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_fullname_k_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for fullname_a field
            //
            $column = new TextViewColumn('fullname_a', 'fullname_a', 'Fullname A', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_fullname_a_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for qualification field
            //
            $column = new TextViewColumn('qualification', 'qualification', 'Qualifications', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_qualification_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for qualification_a field
            //
            $column = new TextViewColumn('qualification_a', 'qualification_a', 'Qualification A', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_qualification_a_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for qualification_k field
            //
            $column = new TextViewColumn('qualification_k', 'qualification_k', 'Qualification K', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_qualification_k_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for doctor_cat field
            //
            $column = new TextViewColumn('doctor_cat_id', 'doctor_cat_id_doctor_cat', 'Staff Type', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_doctor_cat_id_doctor_cat_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for work_email field
            //
            $column = new TextViewColumn('work_email', 'work_email', 'Work Email', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_work_email_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for personal_email field
            //
            $column = new TextViewColumn('personal_email', 'personal_email', 'Personal Email', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_personal_email_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for mobile field
            //
            $column = new TextViewColumn('mobile', 'mobile', 'Mobile', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_mobile_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for work_mobile field
            //
            $column = new TextViewColumn('work_mobile', 'work_mobile', 'Work Mobile', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_work_mobile_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for working_hours field
            //
            $column = new TextViewColumn('working_hours', 'working_hours', 'Working Hours', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_working_hours_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for working_hours_k field
            //
            $column = new TextViewColumn('working_hours_k', 'working_hours_k', 'Working Hours K', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_working_hours_k_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for working_hours_a field
            //
            $column = new TextViewColumn('working_hours_a', 'working_hours_a', 'Working Hours A', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_working_hours_a_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for active field
            //
            $column = new NumberViewColumn('active', 'active', 'Active', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for clinic_address field
            //
            $column = new TextViewColumn('clinic_address', 'clinic_address', 'Clinic Address', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_clinic_address_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for clinic_address_k field
            //
            $column = new TextViewColumn('clinic_address_k', 'clinic_address_k', 'Clinic Address K', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_clinic_address_k_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for clinic_address_a field
            //
            $column = new TextViewColumn('clinic_address_a', 'clinic_address_a', 'Clinic Address A', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_clinic_address_a_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for clinic_mobile field
            //
            $column = new TextViewColumn('clinic_mobile', 'clinic_mobile', 'Clinic Mobile', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_clinic_mobile_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for diploma_id_card field
            //
            $column = new TextViewColumn('diploma_id_card', 'diploma_id_card', 'Diploma Id Card', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_diploma_id_card_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for job_title_e field
            //
            $column = new TextViewColumn('job_title_id', 'job_title_id_job_title_e', 'Job Title', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for first_employment_date field
            //
            $column = new DateTimeViewColumn('first_employment_date', 'first_employment_date', 'First Employment Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d M y');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for salary_amount field
            //
            $column = new NumberViewColumn('salary_amount', 'salary_amount', 'Salary Amount', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for date_of_birth field
            //
            $column = new DateTimeViewColumn('date_of_birth', 'date_of_birth', 'Date Of Birth', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d M y');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for home_address field
            //
            $column = new TextViewColumn('home_address', 'home_address', 'Home Address', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_home_address_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for employment_cat_e field
            //
            $column = new TextViewColumn('employment_cat_id', 'employment_cat_id_employment_cat_e', 'Employment Category', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for support_letter_download_counter field
            //
            $column = new NumberViewColumn('support_letter_download_counter', 'support_letter_download_counter', 'Support Letter Download Counter', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
        }
    
        protected function AddEditColumns(Grid $grid)
        {
            //
            // Edit column for doctor_photo field
            //
            $editor = new ImageUploader('doctor_photo_edit');
            $editor->setInlineStyles('width:150px');
            $editor->SetShowImage(true);
            $editor->setAcceptableFileTypes('image/*');
            $editColumn = new UploadFileToFolderColumn('Doctor Photo(800x600)', 'doctor_photo', $editor, $this->dataset, false, false, '../assets/img/doctors/', '%random%.%original_file_extension%', $this->OnFileUpload, true);
            $editColumn->SetReplaceUploadedFileIfExist(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for fullname field
            //
            $editor = new TextEdit('fullname_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Full name', 'fullname', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for fullname_k field
            //
            $editor = new TextEdit('fullname_k_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Fullname K', 'fullname_k', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for fullname_a field
            //
            $editor = new TextEdit('fullname_a_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Fullname A', 'fullname_a', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for qualification field
            //
            $editor = new TextEdit('qualification_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Qualifications', 'qualification', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for qualification_a field
            //
            $editor = new TextEdit('qualification_a_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Qualification A', 'qualification_a', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for qualification_k field
            //
            $editor = new TextEdit('qualification_k_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Qualification K', 'qualification_k', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for doctor_cat_id field
            //
            $editor = new DynamicCombobox('doctor_cat_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`doctor_cat`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('doctor_cat_id', true, true, true),
                    new StringField('doctor_cat'),
                    new StringField('doctor_cat_K', true),
                    new StringField('doctor_cat_A', true),
                    new IntegerField('publish_id')
                )
            );
            $lookupDataset->setOrderByField('doctor_cat', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Staff Type', 'doctor_cat_id', 'doctor_cat_id_doctor_cat', 'edit_doctor_staff_contracts_job_title_idNestedPage_doctor_cat_id_search', $editor, $this->dataset, $lookupDataset, 'doctor_cat_id', 'doctor_cat', '');
            $editColumn->setNestedInsertFormLink(
                $this->GetHandlerLink(doctor_doctor_cat_idNestedPage::getNestedInsertHandlerName())
            );
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for work_email field
            //
            $editor = new TextEdit('work_email_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Work Email', 'work_email', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for personal_email field
            //
            $editor = new TextEdit('personal_email_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Personal Email', 'personal_email', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for mobile field
            //
            $editor = new TextEdit('mobile_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Mobile', 'mobile', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for work_mobile field
            //
            $editor = new TextEdit('work_mobile_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Work Mobile', 'work_mobile', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for working_hours field
            //
            $editor = new TextEdit('working_hours_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Working Hours', 'working_hours', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for working_hours_k field
            //
            $editor = new TextEdit('working_hours_k_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Working Hours K', 'working_hours_k', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for working_hours_a field
            //
            $editor = new TextEdit('working_hours_a_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Working Hours A', 'working_hours_a', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for active field
            //
            $editor = new RadioEdit('active_edit');
            $editor->SetDisplayMode(RadioEdit::InlineMode);
            $editor->addChoice('1', 'Yes');
            $editor->addChoice('0', 'No');
            $editColumn = new CustomEditColumn('Active', 'active', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for clinic_address field
            //
            $editor = new TextEdit('clinic_address_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Clinic Address', 'clinic_address', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for clinic_address_k field
            //
            $editor = new TextEdit('clinic_address_k_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Clinic Address K', 'clinic_address_k', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for clinic_address_a field
            //
            $editor = new TextEdit('clinic_address_a_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Clinic Address A', 'clinic_address_a', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for clinic_mobile field
            //
            $editor = new TextEdit('clinic_mobile_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Clinic Mobile', 'clinic_mobile', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for diploma_id_card field
            //
            $editor = new TextEdit('diploma_id_card_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Diploma Id Card', 'diploma_id_card', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for job_title_id field
            //
            $editor = new DynamicCombobox('job_title_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`job_title`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('job_title_id', true, true, true),
                    new StringField('job_title_k'),
                    new StringField('job_title_ar'),
                    new StringField('job_title_e')
                )
            );
            $lookupDataset->setOrderByField('job_title_e', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Job Title', 'job_title_id', 'job_title_id_job_title_e', '_doctor_doctor_cat_idNestedPage_job_title_id_search', $editor, $this->dataset, $lookupDataset, 'job_title_id', 'job_title_e', '');
            $editColumn->setNestedInsertFormLink(
                $this->GetHandlerLink(doctor_job_title_idNestedPage::getNestedInsertHandlerName())
            );
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for first_employment_date field
            //
            $editor = new DateTimeEdit('first_employment_date_edit', false, 'd M y');
            $editColumn = new CustomEditColumn('First Employment Date', 'first_employment_date', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for salary_amount field
            //
            $editor = new TextEdit('salary_amount_edit');
            $editColumn = new CustomEditColumn('Salary Amount', 'salary_amount', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for date_of_birth field
            //
            $editor = new DateTimeEdit('date_of_birth_edit', false, 'd M y');
            $editColumn = new CustomEditColumn('Date Of Birth', 'date_of_birth', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for home_address field
            //
            $editor = new TextEdit('home_address_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Home Address', 'home_address', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for employment_cat_id field
            //
            $editor = new DynamicCombobox('employment_cat_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`employment_category`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('employment_cat_id', true, true, true),
                    new StringField('employment_cat_k'),
                    new StringField('employment_cat_a'),
                    new StringField('employment_cat_e')
                )
            );
            $lookupDataset->setOrderByField('employment_cat_e', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Employment Category', 'employment_cat_id', 'employment_cat_id_employment_cat_e', '_doctor_job_title_idNestedPage_employment_cat_id_search', $editor, $this->dataset, $lookupDataset, 'employment_cat_id', 'employment_cat_e', '');
            $editColumn->setNestedInsertFormLink(
                $this->GetHandlerLink(doctor_employment_cat_idNestedPage::getNestedInsertHandlerName())
            );
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for support_letter_download_counter field
            //
            $editor = new TextEdit('support_letter_download_counter_edit');
            $editColumn = new CustomEditColumn('Support Letter Download Counter', 'support_letter_download_counter', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
        }
    
        protected function AddMultiEditColumns(Grid $grid)
        {
            //
            // Edit column for doctor_photo field
            //
            $editor = new ImageUploader('doctor_photo_edit');
            $editor->setInlineStyles('width:150px');
            $editor->SetShowImage(true);
            $editor->setAcceptableFileTypes('image/*');
            $editColumn = new UploadFileToFolderColumn('Doctor Photo(800x600)', 'doctor_photo', $editor, $this->dataset, false, false, '../assets/img/doctors/', '%random%.%original_file_extension%', $this->OnFileUpload, true);
            $editColumn->SetReplaceUploadedFileIfExist(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for fullname field
            //
            $editor = new TextEdit('fullname_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Full name', 'fullname', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for fullname_k field
            //
            $editor = new TextEdit('fullname_k_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Fullname K', 'fullname_k', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for fullname_a field
            //
            $editor = new TextEdit('fullname_a_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Fullname A', 'fullname_a', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for qualification field
            //
            $editor = new TextEdit('qualification_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Qualifications', 'qualification', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for qualification_a field
            //
            $editor = new TextEdit('qualification_a_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Qualification A', 'qualification_a', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for qualification_k field
            //
            $editor = new TextEdit('qualification_k_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Qualification K', 'qualification_k', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for doctor_cat_id field
            //
            $editor = new DynamicCombobox('doctor_cat_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`doctor_cat`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('doctor_cat_id', true, true, true),
                    new StringField('doctor_cat'),
                    new StringField('doctor_cat_K', true),
                    new StringField('doctor_cat_A', true),
                    new IntegerField('publish_id')
                )
            );
            $lookupDataset->setOrderByField('doctor_cat', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Staff Type', 'doctor_cat_id', 'doctor_cat_id_doctor_cat', 'multi_edit_doctor_employment_cat_idNestedPage_doctor_cat_id_search', $editor, $this->dataset, $lookupDataset, 'doctor_cat_id', 'doctor_cat', '');
            $editColumn->setNestedInsertFormLink(
                $this->GetHandlerLink(doctor_doctor_cat_idNestedPage::getNestedInsertHandlerName())
            );
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for work_email field
            //
            $editor = new TextEdit('work_email_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Work Email', 'work_email', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for personal_email field
            //
            $editor = new TextEdit('personal_email_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Personal Email', 'personal_email', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for mobile field
            //
            $editor = new TextEdit('mobile_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Mobile', 'mobile', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for work_mobile field
            //
            $editor = new TextEdit('work_mobile_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Work Mobile', 'work_mobile', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for working_hours field
            //
            $editor = new TextEdit('working_hours_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Working Hours', 'working_hours', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for working_hours_k field
            //
            $editor = new TextEdit('working_hours_k_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Working Hours K', 'working_hours_k', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for working_hours_a field
            //
            $editor = new TextEdit('working_hours_a_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Working Hours A', 'working_hours_a', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for active field
            //
            $editor = new RadioEdit('active_edit');
            $editor->SetDisplayMode(RadioEdit::InlineMode);
            $editor->addChoice('1', 'Yes');
            $editor->addChoice('0', 'No');
            $editColumn = new CustomEditColumn('Active', 'active', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for clinic_address field
            //
            $editor = new TextEdit('clinic_address_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Clinic Address', 'clinic_address', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for clinic_address_k field
            //
            $editor = new TextEdit('clinic_address_k_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Clinic Address K', 'clinic_address_k', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for clinic_address_a field
            //
            $editor = new TextEdit('clinic_address_a_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Clinic Address A', 'clinic_address_a', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for clinic_mobile field
            //
            $editor = new TextEdit('clinic_mobile_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Clinic Mobile', 'clinic_mobile', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for diploma_id_card field
            //
            $editor = new TextEdit('diploma_id_card_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Diploma Id Card', 'diploma_id_card', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for job_title_id field
            //
            $editor = new DynamicCombobox('job_title_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`job_title`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('job_title_id', true, true, true),
                    new StringField('job_title_k'),
                    new StringField('job_title_ar'),
                    new StringField('job_title_e')
                )
            );
            $lookupDataset->setOrderByField('job_title_e', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Job Title', 'job_title_id', 'job_title_id_job_title_e', 'multi_edit_doctor_employment_cat_idNestedPage_job_title_id_search', $editor, $this->dataset, $lookupDataset, 'job_title_id', 'job_title_e', '');
            $editColumn->setNestedInsertFormLink(
                $this->GetHandlerLink(doctor_job_title_idNestedPage::getNestedInsertHandlerName())
            );
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for first_employment_date field
            //
            $editor = new DateTimeEdit('first_employment_date_edit', false, 'd M y');
            $editColumn = new CustomEditColumn('First Employment Date', 'first_employment_date', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for salary_amount field
            //
            $editor = new TextEdit('salary_amount_edit');
            $editColumn = new CustomEditColumn('Salary Amount', 'salary_amount', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for date_of_birth field
            //
            $editor = new DateTimeEdit('date_of_birth_edit', false, 'd M y');
            $editColumn = new CustomEditColumn('Date Of Birth', 'date_of_birth', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for home_address field
            //
            $editor = new TextEdit('home_address_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Home Address', 'home_address', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for employment_cat_id field
            //
            $editor = new DynamicCombobox('employment_cat_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`employment_category`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('employment_cat_id', true, true, true),
                    new StringField('employment_cat_k'),
                    new StringField('employment_cat_a'),
                    new StringField('employment_cat_e')
                )
            );
            $lookupDataset->setOrderByField('employment_cat_e', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Employment Category', 'employment_cat_id', 'employment_cat_id_employment_cat_e', 'multi_edit_doctor_employment_cat_idNestedPage_employment_cat_id_search', $editor, $this->dataset, $lookupDataset, 'employment_cat_id', 'employment_cat_e', '');
            $editColumn->setNestedInsertFormLink(
                $this->GetHandlerLink(doctor_employment_cat_idNestedPage::getNestedInsertHandlerName())
            );
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for support_letter_download_counter field
            //
            $editor = new TextEdit('support_letter_download_counter_edit');
            $editColumn = new CustomEditColumn('Support Letter Download Counter', 'support_letter_download_counter', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
        }
    
        protected function AddInsertColumns(Grid $grid)
        {
            //
            // Edit column for doctor_photo field
            //
            $editor = new ImageUploader('doctor_photo_edit');
            $editor->setInlineStyles('width:150px');
            $editor->SetShowImage(true);
            $editor->setAcceptableFileTypes('image/*');
            $editColumn = new UploadFileToFolderColumn('Doctor Photo(800x600)', 'doctor_photo', $editor, $this->dataset, false, false, '../assets/img/doctors/', '%random%.%original_file_extension%', $this->OnFileUpload, true);
            $editColumn->SetReplaceUploadedFileIfExist(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for fullname field
            //
            $editor = new TextEdit('fullname_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Full name', 'fullname', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for fullname_k field
            //
            $editor = new TextEdit('fullname_k_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Fullname K', 'fullname_k', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for fullname_a field
            //
            $editor = new TextEdit('fullname_a_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Fullname A', 'fullname_a', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for qualification field
            //
            $editor = new TextEdit('qualification_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Qualifications', 'qualification', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for qualification_a field
            //
            $editor = new TextEdit('qualification_a_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Qualification A', 'qualification_a', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for qualification_k field
            //
            $editor = new TextEdit('qualification_k_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Qualification K', 'qualification_k', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for doctor_cat_id field
            //
            $editor = new DynamicCombobox('doctor_cat_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`doctor_cat`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('doctor_cat_id', true, true, true),
                    new StringField('doctor_cat'),
                    new StringField('doctor_cat_K', true),
                    new StringField('doctor_cat_A', true),
                    new IntegerField('publish_id')
                )
            );
            $lookupDataset->setOrderByField('doctor_cat', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Staff Type', 'doctor_cat_id', 'doctor_cat_id_doctor_cat', 'insert_doctor_staff_contracts_job_title_idNestedPage_doctor_cat_id_search', $editor, $this->dataset, $lookupDataset, 'doctor_cat_id', 'doctor_cat', '');
            $editColumn->setNestedInsertFormLink(
                $this->GetHandlerLink(doctor_doctor_cat_idNestedPage::getNestedInsertHandlerName())
            );
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for work_email field
            //
            $editor = new TextEdit('work_email_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Work Email', 'work_email', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for personal_email field
            //
            $editor = new TextEdit('personal_email_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Personal Email', 'personal_email', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for mobile field
            //
            $editor = new TextEdit('mobile_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Mobile', 'mobile', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for work_mobile field
            //
            $editor = new TextEdit('work_mobile_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Work Mobile', 'work_mobile', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for working_hours field
            //
            $editor = new TextEdit('working_hours_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Working Hours', 'working_hours', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for working_hours_k field
            //
            $editor = new TextEdit('working_hours_k_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Working Hours K', 'working_hours_k', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for working_hours_a field
            //
            $editor = new TextEdit('working_hours_a_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Working Hours A', 'working_hours_a', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for active field
            //
            $editor = new RadioEdit('active_edit');
            $editor->SetDisplayMode(RadioEdit::InlineMode);
            $editor->addChoice('1', 'Yes');
            $editor->addChoice('0', 'No');
            $editColumn = new CustomEditColumn('Active', 'active', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for clinic_address field
            //
            $editor = new TextEdit('clinic_address_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Clinic Address', 'clinic_address', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for clinic_address_k field
            //
            $editor = new TextEdit('clinic_address_k_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Clinic Address K', 'clinic_address_k', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for clinic_address_a field
            //
            $editor = new TextEdit('clinic_address_a_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Clinic Address A', 'clinic_address_a', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for clinic_mobile field
            //
            $editor = new TextEdit('clinic_mobile_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Clinic Mobile', 'clinic_mobile', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for diploma_id_card field
            //
            $editor = new TextEdit('diploma_id_card_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Diploma Id Card', 'diploma_id_card', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for job_title_id field
            //
            $editor = new DynamicCombobox('job_title_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`job_title`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('job_title_id', true, true, true),
                    new StringField('job_title_k'),
                    new StringField('job_title_ar'),
                    new StringField('job_title_e')
                )
            );
            $lookupDataset->setOrderByField('job_title_e', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Job Title', 'job_title_id', 'job_title_id_job_title_e', 'insert_doctor_staff_contracts_job_title_idNestedPage_job_title_id_search', $editor, $this->dataset, $lookupDataset, 'job_title_id', 'job_title_e', '');
            $editColumn->setNestedInsertFormLink(
                $this->GetHandlerLink(doctor_job_title_idNestedPage::getNestedInsertHandlerName())
            );
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for first_employment_date field
            //
            $editor = new DateTimeEdit('first_employment_date_edit', false, 'd M y');
            $editColumn = new CustomEditColumn('First Employment Date', 'first_employment_date', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for salary_amount field
            //
            $editor = new TextEdit('salary_amount_edit');
            $editColumn = new CustomEditColumn('Salary Amount', 'salary_amount', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for date_of_birth field
            //
            $editor = new DateTimeEdit('date_of_birth_edit', false, 'd M y');
            $editColumn = new CustomEditColumn('Date Of Birth', 'date_of_birth', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for home_address field
            //
            $editor = new TextEdit('home_address_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Home Address', 'home_address', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for employment_cat_id field
            //
            $editor = new DynamicCombobox('employment_cat_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`employment_category`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('employment_cat_id', true, true, true),
                    new StringField('employment_cat_k'),
                    new StringField('employment_cat_a'),
                    new StringField('employment_cat_e')
                )
            );
            $lookupDataset->setOrderByField('employment_cat_e', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Employment Category', 'employment_cat_id', 'employment_cat_id_employment_cat_e', 'insert_doctor_staff_contracts_job_title_idNestedPage_employment_cat_id_search', $editor, $this->dataset, $lookupDataset, 'employment_cat_id', 'employment_cat_e', '');
            $editColumn->setNestedInsertFormLink(
                $this->GetHandlerLink(doctor_employment_cat_idNestedPage::getNestedInsertHandlerName())
            );
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for support_letter_download_counter field
            //
            $editor = new TextEdit('support_letter_download_counter_edit');
            $editColumn = new CustomEditColumn('Support Letter Download Counter', 'support_letter_download_counter', $editor, $this->dataset);
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
            // View column for doctor_photo field
            //
            $column = new ExternalImageViewColumn('doctor_photo', 'doctor_photo', 'Doctor Photo(800x600)', $this->dataset);
            $column->SetOrderable(true);
            $column->setSourcePrefixTemplate('../assets/img/doctors/');
            $column->setWidth('150px');
            $grid->AddPrintColumn($column);
            
            //
            // View column for fullname field
            //
            $column = new TextViewColumn('fullname', 'fullname', 'Full name', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_fullname_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for fullname_k field
            //
            $column = new TextViewColumn('fullname_k', 'fullname_k', 'Fullname K', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_fullname_k_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for fullname_a field
            //
            $column = new TextViewColumn('fullname_a', 'fullname_a', 'Fullname A', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_fullname_a_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for qualification field
            //
            $column = new TextViewColumn('qualification', 'qualification', 'Qualifications', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_qualification_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for qualification_a field
            //
            $column = new TextViewColumn('qualification_a', 'qualification_a', 'Qualification A', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_qualification_a_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for qualification_k field
            //
            $column = new TextViewColumn('qualification_k', 'qualification_k', 'Qualification K', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_qualification_k_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for doctor_cat field
            //
            $column = new TextViewColumn('doctor_cat_id', 'doctor_cat_id_doctor_cat', 'Staff Type', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_doctor_cat_id_doctor_cat_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for work_email field
            //
            $column = new TextViewColumn('work_email', 'work_email', 'Work Email', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_work_email_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for personal_email field
            //
            $column = new TextViewColumn('personal_email', 'personal_email', 'Personal Email', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_personal_email_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for mobile field
            //
            $column = new TextViewColumn('mobile', 'mobile', 'Mobile', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_mobile_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for work_mobile field
            //
            $column = new TextViewColumn('work_mobile', 'work_mobile', 'Work Mobile', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_work_mobile_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for working_hours field
            //
            $column = new TextViewColumn('working_hours', 'working_hours', 'Working Hours', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_working_hours_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for working_hours_k field
            //
            $column = new TextViewColumn('working_hours_k', 'working_hours_k', 'Working Hours K', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_working_hours_k_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for working_hours_a field
            //
            $column = new TextViewColumn('working_hours_a', 'working_hours_a', 'Working Hours A', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_working_hours_a_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for active field
            //
            $column = new NumberViewColumn('active', 'active', 'Active', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for clinic_address field
            //
            $column = new TextViewColumn('clinic_address', 'clinic_address', 'Clinic Address', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_clinic_address_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for clinic_address_k field
            //
            $column = new TextViewColumn('clinic_address_k', 'clinic_address_k', 'Clinic Address K', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_clinic_address_k_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for clinic_address_a field
            //
            $column = new TextViewColumn('clinic_address_a', 'clinic_address_a', 'Clinic Address A', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_clinic_address_a_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for clinic_mobile field
            //
            $column = new TextViewColumn('clinic_mobile', 'clinic_mobile', 'Clinic Mobile', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_clinic_mobile_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for diploma_id_card field
            //
            $column = new TextViewColumn('diploma_id_card', 'diploma_id_card', 'Diploma Id Card', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_diploma_id_card_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for job_title_e field
            //
            $column = new TextViewColumn('job_title_id', 'job_title_id_job_title_e', 'Job Title', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for first_employment_date field
            //
            $column = new DateTimeViewColumn('first_employment_date', 'first_employment_date', 'First Employment Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d M y');
            $grid->AddPrintColumn($column);
            
            //
            // View column for salary_amount field
            //
            $column = new NumberViewColumn('salary_amount', 'salary_amount', 'Salary Amount', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for date_of_birth field
            //
            $column = new DateTimeViewColumn('date_of_birth', 'date_of_birth', 'Date Of Birth', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d M y');
            $grid->AddPrintColumn($column);
            
            //
            // View column for home_address field
            //
            $column = new TextViewColumn('home_address', 'home_address', 'Home Address', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_home_address_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for employment_cat_e field
            //
            $column = new TextViewColumn('employment_cat_id', 'employment_cat_id_employment_cat_e', 'Employment Category', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for support_letter_download_counter field
            //
            $column = new NumberViewColumn('support_letter_download_counter', 'support_letter_download_counter', 'Support Letter Download Counter', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
        }
    
        protected function AddExportColumns(Grid $grid)
        {
            //
            // View column for doctor_photo field
            //
            $column = new ExternalImageViewColumn('doctor_photo', 'doctor_photo', 'Doctor Photo(800x600)', $this->dataset);
            $column->SetOrderable(true);
            $column->setSourcePrefixTemplate('../assets/img/doctors/');
            $column->setWidth('150px');
            $grid->AddExportColumn($column);
            
            //
            // View column for fullname field
            //
            $column = new TextViewColumn('fullname', 'fullname', 'Full name', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_fullname_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for fullname_k field
            //
            $column = new TextViewColumn('fullname_k', 'fullname_k', 'Fullname K', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_fullname_k_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for fullname_a field
            //
            $column = new TextViewColumn('fullname_a', 'fullname_a', 'Fullname A', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_fullname_a_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for qualification field
            //
            $column = new TextViewColumn('qualification', 'qualification', 'Qualifications', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_qualification_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for qualification_a field
            //
            $column = new TextViewColumn('qualification_a', 'qualification_a', 'Qualification A', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_qualification_a_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for qualification_k field
            //
            $column = new TextViewColumn('qualification_k', 'qualification_k', 'Qualification K', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_qualification_k_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for doctor_cat field
            //
            $column = new TextViewColumn('doctor_cat_id', 'doctor_cat_id_doctor_cat', 'Staff Type', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_doctor_cat_id_doctor_cat_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for work_email field
            //
            $column = new TextViewColumn('work_email', 'work_email', 'Work Email', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_work_email_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for personal_email field
            //
            $column = new TextViewColumn('personal_email', 'personal_email', 'Personal Email', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_personal_email_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for mobile field
            //
            $column = new TextViewColumn('mobile', 'mobile', 'Mobile', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_mobile_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for work_mobile field
            //
            $column = new TextViewColumn('work_mobile', 'work_mobile', 'Work Mobile', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_work_mobile_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for working_hours field
            //
            $column = new TextViewColumn('working_hours', 'working_hours', 'Working Hours', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_working_hours_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for working_hours_k field
            //
            $column = new TextViewColumn('working_hours_k', 'working_hours_k', 'Working Hours K', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_working_hours_k_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for working_hours_a field
            //
            $column = new TextViewColumn('working_hours_a', 'working_hours_a', 'Working Hours A', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_working_hours_a_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for active field
            //
            $column = new NumberViewColumn('active', 'active', 'Active', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for clinic_address field
            //
            $column = new TextViewColumn('clinic_address', 'clinic_address', 'Clinic Address', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_clinic_address_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for clinic_address_k field
            //
            $column = new TextViewColumn('clinic_address_k', 'clinic_address_k', 'Clinic Address K', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_clinic_address_k_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for clinic_address_a field
            //
            $column = new TextViewColumn('clinic_address_a', 'clinic_address_a', 'Clinic Address A', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_clinic_address_a_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for clinic_mobile field
            //
            $column = new TextViewColumn('clinic_mobile', 'clinic_mobile', 'Clinic Mobile', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_clinic_mobile_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for diploma_id_card field
            //
            $column = new TextViewColumn('diploma_id_card', 'diploma_id_card', 'Diploma Id Card', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_diploma_id_card_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for job_title_e field
            //
            $column = new TextViewColumn('job_title_id', 'job_title_id_job_title_e', 'Job Title', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for first_employment_date field
            //
            $column = new DateTimeViewColumn('first_employment_date', 'first_employment_date', 'First Employment Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d M y');
            $grid->AddExportColumn($column);
            
            //
            // View column for salary_amount field
            //
            $column = new NumberViewColumn('salary_amount', 'salary_amount', 'Salary Amount', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for date_of_birth field
            //
            $column = new DateTimeViewColumn('date_of_birth', 'date_of_birth', 'Date Of Birth', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d M y');
            $grid->AddExportColumn($column);
            
            //
            // View column for home_address field
            //
            $column = new TextViewColumn('home_address', 'home_address', 'Home Address', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_home_address_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for employment_cat_e field
            //
            $column = new TextViewColumn('employment_cat_id', 'employment_cat_id_employment_cat_e', 'Employment Category', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for support_letter_download_counter field
            //
            $column = new NumberViewColumn('support_letter_download_counter', 'support_letter_download_counter', 'Support Letter Download Counter', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
        }
    
        private function AddCompareColumns(Grid $grid)
        {
            //
            // View column for doctor_photo field
            //
            $column = new ExternalImageViewColumn('doctor_photo', 'doctor_photo', 'Doctor Photo(800x600)', $this->dataset);
            $column->SetOrderable(true);
            $column->setSourcePrefixTemplate('../assets/img/doctors/');
            $column->setWidth('150px');
            $grid->AddCompareColumn($column);
            
            //
            // View column for fullname field
            //
            $column = new TextViewColumn('fullname', 'fullname', 'Full name', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_fullname_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for fullname_k field
            //
            $column = new TextViewColumn('fullname_k', 'fullname_k', 'Fullname K', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_fullname_k_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for fullname_a field
            //
            $column = new TextViewColumn('fullname_a', 'fullname_a', 'Fullname A', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_fullname_a_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for qualification field
            //
            $column = new TextViewColumn('qualification', 'qualification', 'Qualifications', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_qualification_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for qualification_a field
            //
            $column = new TextViewColumn('qualification_a', 'qualification_a', 'Qualification A', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_qualification_a_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for qualification_k field
            //
            $column = new TextViewColumn('qualification_k', 'qualification_k', 'Qualification K', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_qualification_k_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for doctor_cat field
            //
            $column = new TextViewColumn('doctor_cat_id', 'doctor_cat_id_doctor_cat', 'Staff Type', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_doctor_cat_id_doctor_cat_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for work_email field
            //
            $column = new TextViewColumn('work_email', 'work_email', 'Work Email', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_work_email_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for personal_email field
            //
            $column = new TextViewColumn('personal_email', 'personal_email', 'Personal Email', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_personal_email_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for mobile field
            //
            $column = new TextViewColumn('mobile', 'mobile', 'Mobile', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_mobile_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for work_mobile field
            //
            $column = new TextViewColumn('work_mobile', 'work_mobile', 'Work Mobile', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_work_mobile_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for working_hours field
            //
            $column = new TextViewColumn('working_hours', 'working_hours', 'Working Hours', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_working_hours_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for working_hours_k field
            //
            $column = new TextViewColumn('working_hours_k', 'working_hours_k', 'Working Hours K', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_working_hours_k_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for working_hours_a field
            //
            $column = new TextViewColumn('working_hours_a', 'working_hours_a', 'Working Hours A', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_working_hours_a_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for active field
            //
            $column = new NumberViewColumn('active', 'active', 'Active', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for clinic_address field
            //
            $column = new TextViewColumn('clinic_address', 'clinic_address', 'Clinic Address', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_clinic_address_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for clinic_address_k field
            //
            $column = new TextViewColumn('clinic_address_k', 'clinic_address_k', 'Clinic Address K', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_clinic_address_k_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for clinic_address_a field
            //
            $column = new TextViewColumn('clinic_address_a', 'clinic_address_a', 'Clinic Address A', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_clinic_address_a_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for clinic_mobile field
            //
            $column = new TextViewColumn('clinic_mobile', 'clinic_mobile', 'Clinic Mobile', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_clinic_mobile_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for diploma_id_card field
            //
            $column = new TextViewColumn('diploma_id_card', 'diploma_id_card', 'Diploma Id Card', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_diploma_id_card_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for job_title_e field
            //
            $column = new TextViewColumn('job_title_id', 'job_title_id_job_title_e', 'Job Title', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for first_employment_date field
            //
            $column = new DateTimeViewColumn('first_employment_date', 'first_employment_date', 'First Employment Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d M y');
            $grid->AddCompareColumn($column);
            
            //
            // View column for salary_amount field
            //
            $column = new NumberViewColumn('salary_amount', 'salary_amount', 'Salary Amount', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for date_of_birth field
            //
            $column = new DateTimeViewColumn('date_of_birth', 'date_of_birth', 'Date Of Birth', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d M y');
            $grid->AddCompareColumn($column);
            
            //
            // View column for home_address field
            //
            $column = new TextViewColumn('home_address', 'home_address', 'Home Address', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_home_address_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for employment_cat_e field
            //
            $column = new TextViewColumn('employment_cat_id', 'employment_cat_id_employment_cat_e', 'Employment Category', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for support_letter_download_counter field
            //
            $column = new NumberViewColumn('support_letter_download_counter', 'support_letter_download_counter', 'Support Letter Download Counter', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
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
    
        function CreateMasterDetailRecordGrid()
        {
            $result = new Grid($this, $this->dataset);
            
            $this->AddFieldColumns($result, false);
            $this->AddPrintColumns($result);
            $this->AddExportColumns($result);
            
            $result->SetAllowDeleteSelected(false);
            $result->SetShowUpdateLink(false);
            $result->SetShowKeyColumnsImagesInHeader(false);
            $result->SetViewMode(ViewMode::TABLE);
            $result->setEnableRuntimeCustomization(false);
            $result->setTableBordered(true);
            $result->setTableCondensed(true);
            
            $this->setupGridColumnGroup($result);
            $this->attachGridEventHandlers($result);
            
            return $result;
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
            $detailPage = new doctor_staff_contractsPage('doctor_staff_contracts', $this, array('doctor_id'), array('doctor_id'), $this->GetForeignKeyFields(), $this->CreateMasterDetailRecordGrid(), $this->dataset, GetCurrentUserPermissionSetForDataSource('doctor.staff_contracts'), 'UTF-8');
            $detailPage->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource('doctor.staff_contracts'));
            $detailPage->SetHttpHandlerName('doctor_staff_contracts_handler');
            $handler = new PageHTTPHandler('doctor_staff_contracts_handler', $detailPage);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for fullname field
            //
            $column = new TextViewColumn('fullname', 'fullname', 'Full name', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'doctorGrid_fullname_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for doctor_cat field
            //
            $column = new TextViewColumn('doctor_cat_id', 'doctor_cat_id_doctor_cat', 'Staff Type', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'doctorGrid_doctor_cat_id_doctor_cat_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for work_email field
            //
            $column = new TextViewColumn('work_email', 'work_email', 'Work Email', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'doctorGrid_work_email_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for mobile field
            //
            $column = new TextViewColumn('mobile', 'mobile', 'Mobile', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'doctorGrid_mobile_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for work_mobile field
            //
            $column = new TextViewColumn('work_mobile', 'work_mobile', 'Work Mobile', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'doctorGrid_work_mobile_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for clinic_mobile field
            //
            $column = new TextViewColumn('clinic_mobile', 'clinic_mobile', 'Clinic Mobile', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'doctorGrid_clinic_mobile_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for fullname field
            //
            $column = new TextViewColumn('fullname', 'fullname', 'Full name', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'doctorGrid_fullname_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for fullname_k field
            //
            $column = new TextViewColumn('fullname_k', 'fullname_k', 'Fullname K', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'doctorGrid_fullname_k_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for fullname_a field
            //
            $column = new TextViewColumn('fullname_a', 'fullname_a', 'Fullname A', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'doctorGrid_fullname_a_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for qualification field
            //
            $column = new TextViewColumn('qualification', 'qualification', 'Qualifications', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'doctorGrid_qualification_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for qualification_a field
            //
            $column = new TextViewColumn('qualification_a', 'qualification_a', 'Qualification A', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'doctorGrid_qualification_a_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for qualification_k field
            //
            $column = new TextViewColumn('qualification_k', 'qualification_k', 'Qualification K', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'doctorGrid_qualification_k_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for doctor_cat field
            //
            $column = new TextViewColumn('doctor_cat_id', 'doctor_cat_id_doctor_cat', 'Staff Type', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'doctorGrid_doctor_cat_id_doctor_cat_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for work_email field
            //
            $column = new TextViewColumn('work_email', 'work_email', 'Work Email', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'doctorGrid_work_email_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for personal_email field
            //
            $column = new TextViewColumn('personal_email', 'personal_email', 'Personal Email', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'doctorGrid_personal_email_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for mobile field
            //
            $column = new TextViewColumn('mobile', 'mobile', 'Mobile', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'doctorGrid_mobile_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for work_mobile field
            //
            $column = new TextViewColumn('work_mobile', 'work_mobile', 'Work Mobile', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'doctorGrid_work_mobile_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for working_hours field
            //
            $column = new TextViewColumn('working_hours', 'working_hours', 'Working Hours', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'doctorGrid_working_hours_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for working_hours_k field
            //
            $column = new TextViewColumn('working_hours_k', 'working_hours_k', 'Working Hours K', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'doctorGrid_working_hours_k_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for working_hours_a field
            //
            $column = new TextViewColumn('working_hours_a', 'working_hours_a', 'Working Hours A', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'doctorGrid_working_hours_a_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for clinic_address field
            //
            $column = new TextViewColumn('clinic_address', 'clinic_address', 'Clinic Address', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'doctorGrid_clinic_address_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for clinic_address_k field
            //
            $column = new TextViewColumn('clinic_address_k', 'clinic_address_k', 'Clinic Address K', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'doctorGrid_clinic_address_k_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for clinic_address_a field
            //
            $column = new TextViewColumn('clinic_address_a', 'clinic_address_a', 'Clinic Address A', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'doctorGrid_clinic_address_a_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for clinic_mobile field
            //
            $column = new TextViewColumn('clinic_mobile', 'clinic_mobile', 'Clinic Mobile', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'doctorGrid_clinic_mobile_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for diploma_id_card field
            //
            $column = new TextViewColumn('diploma_id_card', 'diploma_id_card', 'Diploma Id Card', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'doctorGrid_diploma_id_card_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for home_address field
            //
            $column = new TextViewColumn('home_address', 'home_address', 'Home Address', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'doctorGrid_home_address_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for fullname field
            //
            $column = new TextViewColumn('fullname', 'fullname', 'Full name', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'doctorGrid_fullname_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for fullname_k field
            //
            $column = new TextViewColumn('fullname_k', 'fullname_k', 'Fullname K', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'doctorGrid_fullname_k_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for fullname_a field
            //
            $column = new TextViewColumn('fullname_a', 'fullname_a', 'Fullname A', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'doctorGrid_fullname_a_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for qualification field
            //
            $column = new TextViewColumn('qualification', 'qualification', 'Qualifications', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'doctorGrid_qualification_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for qualification_a field
            //
            $column = new TextViewColumn('qualification_a', 'qualification_a', 'Qualification A', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'doctorGrid_qualification_a_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for qualification_k field
            //
            $column = new TextViewColumn('qualification_k', 'qualification_k', 'Qualification K', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'doctorGrid_qualification_k_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for doctor_cat field
            //
            $column = new TextViewColumn('doctor_cat_id', 'doctor_cat_id_doctor_cat', 'Staff Type', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'doctorGrid_doctor_cat_id_doctor_cat_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for work_email field
            //
            $column = new TextViewColumn('work_email', 'work_email', 'Work Email', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'doctorGrid_work_email_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for personal_email field
            //
            $column = new TextViewColumn('personal_email', 'personal_email', 'Personal Email', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'doctorGrid_personal_email_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for mobile field
            //
            $column = new TextViewColumn('mobile', 'mobile', 'Mobile', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'doctorGrid_mobile_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for work_mobile field
            //
            $column = new TextViewColumn('work_mobile', 'work_mobile', 'Work Mobile', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'doctorGrid_work_mobile_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for working_hours field
            //
            $column = new TextViewColumn('working_hours', 'working_hours', 'Working Hours', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'doctorGrid_working_hours_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for working_hours_k field
            //
            $column = new TextViewColumn('working_hours_k', 'working_hours_k', 'Working Hours K', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'doctorGrid_working_hours_k_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for working_hours_a field
            //
            $column = new TextViewColumn('working_hours_a', 'working_hours_a', 'Working Hours A', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'doctorGrid_working_hours_a_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for clinic_address field
            //
            $column = new TextViewColumn('clinic_address', 'clinic_address', 'Clinic Address', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'doctorGrid_clinic_address_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for clinic_address_k field
            //
            $column = new TextViewColumn('clinic_address_k', 'clinic_address_k', 'Clinic Address K', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'doctorGrid_clinic_address_k_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for clinic_address_a field
            //
            $column = new TextViewColumn('clinic_address_a', 'clinic_address_a', 'Clinic Address A', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'doctorGrid_clinic_address_a_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for clinic_mobile field
            //
            $column = new TextViewColumn('clinic_mobile', 'clinic_mobile', 'Clinic Mobile', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'doctorGrid_clinic_mobile_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for diploma_id_card field
            //
            $column = new TextViewColumn('diploma_id_card', 'diploma_id_card', 'Diploma Id Card', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'doctorGrid_diploma_id_card_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for home_address field
            //
            $column = new TextViewColumn('home_address', 'home_address', 'Home Address', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'doctorGrid_home_address_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`doctor_cat`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('doctor_cat_id', true, true, true),
                    new StringField('doctor_cat'),
                    new StringField('doctor_cat_K', true),
                    new StringField('doctor_cat_A', true),
                    new IntegerField('publish_id')
                )
            );
            $lookupDataset->setOrderByField('doctor_cat', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_doctor_staff_contracts_job_title_idNestedPage_doctor_cat_id_search', 'doctor_cat_id', 'doctor_cat', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`job_title`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('job_title_id', true, true, true),
                    new StringField('job_title_k'),
                    new StringField('job_title_ar'),
                    new StringField('job_title_e')
                )
            );
            $lookupDataset->setOrderByField('job_title_e', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_doctor_staff_contracts_job_title_idNestedPage_job_title_id_search', 'job_title_id', 'job_title_e', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`employment_category`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('employment_cat_id', true, true, true),
                    new StringField('employment_cat_k'),
                    new StringField('employment_cat_a'),
                    new StringField('employment_cat_e')
                )
            );
            $lookupDataset->setOrderByField('employment_cat_e', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_doctor_staff_contracts_job_title_idNestedPage_employment_cat_id_search', 'employment_cat_id', 'employment_cat_e', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`doctor_cat`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('doctor_cat_id', true, true, true),
                    new StringField('doctor_cat'),
                    new StringField('doctor_cat_K', true),
                    new StringField('doctor_cat_A', true),
                    new IntegerField('publish_id')
                )
            );
            $lookupDataset->setOrderByField('doctor_cat', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_doctor_staff_contracts_job_title_idNestedPage_doctor_cat_id_search', 'doctor_cat_id', 'doctor_cat', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`job_title`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('job_title_id', true, true, true),
                    new StringField('job_title_k'),
                    new StringField('job_title_ar'),
                    new StringField('job_title_e')
                )
            );
            $lookupDataset->setOrderByField('job_title_e', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_doctor_staff_contracts_job_title_idNestedPage_job_title_id_search', 'job_title_id', 'job_title_e', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`employment_category`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('employment_cat_id', true, true, true),
                    new StringField('employment_cat_k'),
                    new StringField('employment_cat_a'),
                    new StringField('employment_cat_e')
                )
            );
            $lookupDataset->setOrderByField('employment_cat_e', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_doctor_staff_contracts_job_title_idNestedPage_employment_cat_id_search', 'employment_cat_id', 'employment_cat_e', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for fullname field
            //
            $column = new TextViewColumn('fullname', 'fullname', 'Full name', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'doctorGrid_fullname_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for fullname_k field
            //
            $column = new TextViewColumn('fullname_k', 'fullname_k', 'Fullname K', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'doctorGrid_fullname_k_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for fullname_a field
            //
            $column = new TextViewColumn('fullname_a', 'fullname_a', 'Fullname A', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'doctorGrid_fullname_a_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for qualification field
            //
            $column = new TextViewColumn('qualification', 'qualification', 'Qualifications', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'doctorGrid_qualification_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for qualification_a field
            //
            $column = new TextViewColumn('qualification_a', 'qualification_a', 'Qualification A', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'doctorGrid_qualification_a_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for qualification_k field
            //
            $column = new TextViewColumn('qualification_k', 'qualification_k', 'Qualification K', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'doctorGrid_qualification_k_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for doctor_cat field
            //
            $column = new TextViewColumn('doctor_cat_id', 'doctor_cat_id_doctor_cat', 'Staff Type', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'doctorGrid_doctor_cat_id_doctor_cat_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for work_email field
            //
            $column = new TextViewColumn('work_email', 'work_email', 'Work Email', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'doctorGrid_work_email_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for personal_email field
            //
            $column = new TextViewColumn('personal_email', 'personal_email', 'Personal Email', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'doctorGrid_personal_email_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for mobile field
            //
            $column = new TextViewColumn('mobile', 'mobile', 'Mobile', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'doctorGrid_mobile_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for work_mobile field
            //
            $column = new TextViewColumn('work_mobile', 'work_mobile', 'Work Mobile', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'doctorGrid_work_mobile_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for working_hours field
            //
            $column = new TextViewColumn('working_hours', 'working_hours', 'Working Hours', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'doctorGrid_working_hours_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for working_hours_k field
            //
            $column = new TextViewColumn('working_hours_k', 'working_hours_k', 'Working Hours K', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'doctorGrid_working_hours_k_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for working_hours_a field
            //
            $column = new TextViewColumn('working_hours_a', 'working_hours_a', 'Working Hours A', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'doctorGrid_working_hours_a_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for clinic_address field
            //
            $column = new TextViewColumn('clinic_address', 'clinic_address', 'Clinic Address', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'doctorGrid_clinic_address_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for clinic_address_k field
            //
            $column = new TextViewColumn('clinic_address_k', 'clinic_address_k', 'Clinic Address K', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'doctorGrid_clinic_address_k_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for clinic_address_a field
            //
            $column = new TextViewColumn('clinic_address_a', 'clinic_address_a', 'Clinic Address A', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'doctorGrid_clinic_address_a_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for clinic_mobile field
            //
            $column = new TextViewColumn('clinic_mobile', 'clinic_mobile', 'Clinic Mobile', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'doctorGrid_clinic_mobile_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for diploma_id_card field
            //
            $column = new TextViewColumn('diploma_id_card', 'diploma_id_card', 'Diploma Id Card', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'doctorGrid_diploma_id_card_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for home_address field
            //
            $column = new TextViewColumn('home_address', 'home_address', 'Home Address', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'doctorGrid_home_address_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`doctor_cat`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('doctor_cat_id', true, true, true),
                    new StringField('doctor_cat'),
                    new StringField('doctor_cat_K', true),
                    new StringField('doctor_cat_A', true),
                    new IntegerField('publish_id')
                )
            );
            $lookupDataset->setOrderByField('doctor_cat', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_doctor_staff_contracts_job_title_idNestedPage_doctor_cat_id_search', 'doctor_cat_id', 'doctor_cat', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`job_title`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('job_title_id', true, true, true),
                    new StringField('job_title_k'),
                    new StringField('job_title_ar'),
                    new StringField('job_title_e')
                )
            );
            $lookupDataset->setOrderByField('job_title_e', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, '_doctor_doctor_cat_idNestedPage_job_title_id_search', 'job_title_id', 'job_title_e', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`employment_category`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('employment_cat_id', true, true, true),
                    new StringField('employment_cat_k'),
                    new StringField('employment_cat_a'),
                    new StringField('employment_cat_e')
                )
            );
            $lookupDataset->setOrderByField('employment_cat_e', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, '_doctor_job_title_idNestedPage_employment_cat_id_search', 'employment_cat_id', 'employment_cat_e', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`doctor_cat`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('doctor_cat_id', true, true, true),
                    new StringField('doctor_cat'),
                    new StringField('doctor_cat_K', true),
                    new StringField('doctor_cat_A', true),
                    new IntegerField('publish_id')
                )
            );
            $lookupDataset->setOrderByField('doctor_cat', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_doctor_employment_cat_idNestedPage_doctor_cat_id_search', 'doctor_cat_id', 'doctor_cat', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`job_title`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('job_title_id', true, true, true),
                    new StringField('job_title_k'),
                    new StringField('job_title_ar'),
                    new StringField('job_title_e')
                )
            );
            $lookupDataset->setOrderByField('job_title_e', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_doctor_employment_cat_idNestedPage_job_title_id_search', 'job_title_id', 'job_title_e', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`employment_category`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('employment_cat_id', true, true, true),
                    new StringField('employment_cat_k'),
                    new StringField('employment_cat_a'),
                    new StringField('employment_cat_e')
                )
            );
            $lookupDataset->setOrderByField('employment_cat_e', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_doctor_employment_cat_idNestedPage_employment_cat_id_search', 'employment_cat_id', 'employment_cat_e', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            
            
            
            
            
            
            
            
            
            
            
            new doctor_staff_contracts_job_title_idNestedPage($this, GetCurrentUserPermissionSetForDataSource('doctor.staff_contracts.job_title_id'));
            new doctor_doctor_cat_idNestedPage($this, GetCurrentUserPermissionSetForDataSource('doctor.doctor_cat_id'));
            new doctor_job_title_idNestedPage($this, GetCurrentUserPermissionSetForDataSource('doctor.job_title_id'));
            new doctor_employment_cat_idNestedPage($this, GetCurrentUserPermissionSetForDataSource('doctor.employment_cat_id'));
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
        $Page = new doctorPage("doctor", "staff.php", GetCurrentUserPermissionSetForDataSource("doctor"), 'UTF-8');
        $Page->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource("doctor"));
        GetApplication()->SetMainPage($Page);
        GetApplication()->Run();
    }
    catch(Exception $e)
    {
        ShowErrorPage($e);
    }
	
