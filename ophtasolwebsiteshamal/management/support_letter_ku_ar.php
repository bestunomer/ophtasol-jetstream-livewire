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
    
    
    
    class support_letter01Page extends Page
    {
        protected function DoBeforeCreate()
        {
            $this->SetTitle('Support Letter Kurdish-Arabic');
            $this->SetMenuLabel('Support Letter Kurdish-Arabic');
            $this->SetHeader(GetPagesHeader());
            $this->SetFooter(GetPagesFooter());
    
            $this->dataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`support_letter`');
            $this->dataset->addFields(
                array(
                    new IntegerField('support_id', true, true, true),
                    new DateField('support_request_date'),
                    new StringField('letter_to'),
                    new IntegerField('doctor_id'),
                    new StringField('letter_title'),
                    new IntegerField('language_id')
                )
            );
            $this->dataset->AddLookupField('doctor_id', 'doctor', new IntegerField('doctor_id'), new StringField('fullname', false, false, false, false, 'doctor_id_fullname', 'doctor_id_fullname_doctor'), 'doctor_id_fullname_doctor');
            $this->dataset->AddLookupField('language_id', 'language', new IntegerField('language_id'), new StringField('language', false, false, false, false, 'language_id_language', 'language_id_language_language'), 'language_id_language_language');
            $this->dataset->AddCustomCondition(EnvVariablesUtils::EvaluateVariableTemplate($this->GetColumnVariableContainer(), 'support_letter.language_id=2'));
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
                new FilterColumn($this->dataset, 'support_id', 'support_id', 'Support Id'),
                new FilterColumn($this->dataset, 'support_request_date', 'support_request_date', 'Support Request Date'),
                new FilterColumn($this->dataset, 'letter_to', 'letter_to', 'Letter To'),
                new FilterColumn($this->dataset, 'doctor_id', 'doctor_id_fullname', 'Staff'),
                new FilterColumn($this->dataset, 'letter_title', 'letter_title', 'Letter Title'),
                new FilterColumn($this->dataset, 'language_id', 'language_id_language', 'Language')
            );
        }
    
        protected function setupQuickFilter(QuickFilter $quickFilter, FixedKeysArray $columns)
        {
            $quickFilter
                ->addColumn($columns['support_request_date'])
                ->addColumn($columns['letter_to'])
                ->addColumn($columns['doctor_id'])
                ->addColumn($columns['letter_title'])
                ->addColumn($columns['language_id']);
        }
    
        protected function setupColumnFilter(ColumnFilter $columnFilter)
        {
            $columnFilter
                ->setOptionsFor('support_request_date')
                ->setOptionsFor('doctor_id')
                ->setOptionsFor('language_id');
        }
    
        protected function setupFilterBuilder(FilterBuilder $filterBuilder, FixedKeysArray $columns)
        {
            $main_editor = new DateTimeEdit('support_request_date_edit', false, 'Y-m-d H:i:s');
            
            $filterBuilder->addColumn(
                $columns['support_request_date'],
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
            
            $main_editor = new TextEdit('letter_to_edit');
            $main_editor->SetMaxLength(250);
            
            $filterBuilder->addColumn(
                $columns['letter_to'],
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
            
            $main_editor = new DynamicCombobox('doctor_id_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_support_letter01_doctor_id_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('doctor_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_support_letter01_doctor_id_search');
            
            $filterBuilder->addColumn(
                $columns['doctor_id'],
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
            
            $main_editor = new TextEdit('letter_title');
            
            $filterBuilder->addColumn(
                $columns['letter_title'],
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
            
            $main_editor = new DynamicCombobox('language_id_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_support_letter01_language_id_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('language_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_support_letter01_language_id_search');
            
            $filterBuilder->addColumn(
                $columns['language_id'],
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
            
            if ($this->GetSecurityInfo()->HasDeleteGrant())
            {
                $operation = new LinkOperation($this->GetLocalizerCaptions()->GetMessageString('Delete'), OPERATION_DELETE, $this->dataset, $grid);
                $operation->setUseImage(false);
                $actions->addOperation($operation);
                $operation->OnShow->AddListener('ShowDeleteButtonHandler', $this);
                $operation->SetAdditionalAttribute('data-modal-operation', 'delete');
                $operation->SetAdditionalAttribute('data-delete-handler-name', $this->GetModalGridDeleteHandler());
            }
        }
    
        protected function AddFieldColumns(Grid $grid, $withDetails = true)
        {
            //
            // View column for support_request_date field
            //
            $column = new DateTimeViewColumn('support_request_date', 'support_request_date', 'Support Request Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d H:i:s');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for letter_to field
            //
            $column = new TextViewColumn('letter_to', 'letter_to', 'Letter To', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('support_letter01Grid_letter_to_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for fullname field
            //
            $column = new TextViewColumn('doctor_id', 'doctor_id_fullname', 'Staff', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for letter_title field
            //
            $column = new TextViewColumn('letter_title', 'letter_title', 'Letter Title', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('support_letter01Grid_letter_title_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for language field
            //
            $column = new TextViewColumn('language_id', 'language_id_language', 'Language', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
        }
    
        protected function AddSingleRecordViewColumns(Grid $grid)
        {
            //
            // View column for support_request_date field
            //
            $column = new DateTimeViewColumn('support_request_date', 'support_request_date', 'Support Request Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d H:i:s');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for letter_to field
            //
            $column = new TextViewColumn('letter_to', 'letter_to', 'Letter To', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('support_letter01Grid_letter_to_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for fullname field
            //
            $column = new TextViewColumn('doctor_id', 'doctor_id_fullname', 'Staff', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for letter_title field
            //
            $column = new TextViewColumn('letter_title', 'letter_title', 'Letter Title', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('support_letter01Grid_letter_title_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for language field
            //
            $column = new TextViewColumn('language_id', 'language_id_language', 'Language', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
        }
    
        protected function AddEditColumns(Grid $grid)
        {
            //
            // Edit column for support_request_date field
            //
            $editor = new DateTimeEdit('support_request_date_edit', false, 'Y-m-d H:i:s');
            $editColumn = new CustomEditColumn('Support Request Date', 'support_request_date', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for letter_to field
            //
            $editor = new TextEdit('letter_to_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Letter To', 'letter_to', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for doctor_id field
            //
            $editor = new DynamicCombobox('doctor_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`doctor`');
            $lookupDataset->addFields(
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
            $lookupDataset->setOrderByField('fullname', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Staff', 'doctor_id', 'doctor_id_fullname', 'edit_support_letter01_doctor_id_search', $editor, $this->dataset, $lookupDataset, 'doctor_id', 'fullname', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for letter_title field
            //
            $editor = new TextAreaEdit('letter_title_edit', 50, 8);
            $editColumn = new CustomEditColumn('Letter Title', 'letter_title', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for language_id field
            //
            $editor = new DynamicCombobox('language_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`language`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('language_id', true, true, true),
                    new StringField('language')
                )
            );
            $lookupDataset->setOrderByField('language', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Language', 'language_id', 'language_id_language', 'edit_support_letter01_language_id_search', $editor, $this->dataset, $lookupDataset, 'language_id', 'language', '');
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
        }
    
        protected function AddMultiEditColumns(Grid $grid)
        {
            //
            // Edit column for support_request_date field
            //
            $editor = new DateTimeEdit('support_request_date_edit', false, 'Y-m-d H:i:s');
            $editColumn = new CustomEditColumn('Support Request Date', 'support_request_date', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for letter_to field
            //
            $editor = new TextEdit('letter_to_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Letter To', 'letter_to', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for doctor_id field
            //
            $editor = new DynamicCombobox('doctor_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`doctor`');
            $lookupDataset->addFields(
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
            $lookupDataset->setOrderByField('fullname', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Staff', 'doctor_id', 'doctor_id_fullname', 'multi_edit_support_letter01_doctor_id_search', $editor, $this->dataset, $lookupDataset, 'doctor_id', 'fullname', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for letter_title field
            //
            $editor = new TextAreaEdit('letter_title_edit', 50, 8);
            $editColumn = new CustomEditColumn('Letter Title', 'letter_title', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for language_id field
            //
            $editor = new DynamicCombobox('language_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`language`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('language_id', true, true, true),
                    new StringField('language')
                )
            );
            $lookupDataset->setOrderByField('language', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Language', 'language_id', 'language_id_language', 'multi_edit_support_letter01_language_id_search', $editor, $this->dataset, $lookupDataset, 'language_id', 'language', '');
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
        }
    
        protected function AddInsertColumns(Grid $grid)
        {
            //
            // Edit column for support_request_date field
            //
            $editor = new DateTimeEdit('support_request_date_edit', false, 'Y-m-d H:i:s');
            $editColumn = new CustomEditColumn('Support Request Date', 'support_request_date', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $editColumn->SetInsertDefaultValue('%CURRENT_DATETIME%');
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for letter_to field
            //
            $editor = new TextEdit('letter_to_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Letter To', 'letter_to', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for doctor_id field
            //
            $editor = new DynamicCombobox('doctor_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`doctor`');
            $lookupDataset->addFields(
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
            $lookupDataset->setOrderByField('fullname', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Staff', 'doctor_id', 'doctor_id_fullname', 'insert_support_letter01_doctor_id_search', $editor, $this->dataset, $lookupDataset, 'doctor_id', 'fullname', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for letter_title field
            //
            $editor = new TextAreaEdit('letter_title_edit', 50, 8);
            $editColumn = new CustomEditColumn('Letter Title', 'letter_title', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for language_id field
            //
            $editor = new DynamicCombobox('language_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`language`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('language_id', true, true, true),
                    new StringField('language')
                )
            );
            $lookupDataset->setOrderByField('language', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Language', 'language_id', 'language_id_language', 'insert_support_letter01_language_id_search', $editor, $this->dataset, $lookupDataset, 'language_id', 'language', '');
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $editColumn->SetInsertDefaultValue('2');
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
            // View column for support_request_date field
            //
            $column = new DateTimeViewColumn('support_request_date', 'support_request_date', 'Support Request Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d H:i:s');
            $grid->AddPrintColumn($column);
            
            //
            // View column for letter_to field
            //
            $column = new TextViewColumn('letter_to', 'letter_to', 'Letter To', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('support_letter01Grid_letter_to_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for fullname field
            //
            $column = new TextViewColumn('doctor_id', 'doctor_id_fullname', 'Staff', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for letter_title field
            //
            $column = new TextViewColumn('letter_title', 'letter_title', 'Letter Title', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('support_letter01Grid_letter_title_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for language field
            //
            $column = new TextViewColumn('language_id', 'language_id_language', 'Language', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
        }
    
        protected function AddExportColumns(Grid $grid)
        {
            //
            // View column for support_request_date field
            //
            $column = new DateTimeViewColumn('support_request_date', 'support_request_date', 'Support Request Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d H:i:s');
            $grid->AddExportColumn($column);
            
            //
            // View column for letter_to field
            //
            $column = new TextViewColumn('letter_to', 'letter_to', 'Letter To', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('support_letter01Grid_letter_to_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for fullname field
            //
            $column = new TextViewColumn('doctor_id', 'doctor_id_fullname', 'Staff', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for letter_title field
            //
            $column = new TextViewColumn('letter_title', 'letter_title', 'Letter Title', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('support_letter01Grid_letter_title_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for language field
            //
            $column = new TextViewColumn('language_id', 'language_id_language', 'Language', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
        }
    
        private function AddCompareColumns(Grid $grid)
        {
            //
            // View column for support_request_date field
            //
            $column = new DateTimeViewColumn('support_request_date', 'support_request_date', 'Support Request Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d H:i:s');
            $grid->AddCompareColumn($column);
            
            //
            // View column for letter_to field
            //
            $column = new TextViewColumn('letter_to', 'letter_to', 'Letter To', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('support_letter01Grid_letter_to_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for fullname field
            //
            $column = new TextViewColumn('doctor_id', 'doctor_id_fullname', 'Staff', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for letter_title field
            //
            $column = new TextViewColumn('letter_title', 'letter_title', 'Letter Title', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('support_letter01Grid_letter_title_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for language field
            //
            $column = new TextViewColumn('language_id', 'language_id_language', 'Language', $this->dataset);
            $column->SetOrderable(true);
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
        
        protected function GetEnableModalGridDelete() { return true; }
    
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
            $result->setMultiEditAllowed($this->GetSecurityInfo()->HasEditGrant() && false);
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
            $this->setPrintListAvailable(false);
            $this->setPrintListRecordAvailable(true);
            $this->setPrintOneRecordAvailable(false);
            $this->setAllowPrintSelectedRecords(false);
            $this->setExportListAvailable(array('excel'));
            $this->setExportSelectedRecordsAvailable(array());
            $this->setExportListRecordAvailable(array('word'));
            $this->setExportOneRecordAvailable(array());
    
            return $result;
        }
     
        protected function setClientSideEvents(Grid $grid) {
    
        }
    
        protected function doRegisterHandlers() {
            //
            // View column for letter_to field
            //
            $column = new TextViewColumn('letter_to', 'letter_to', 'Letter To', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'support_letter01Grid_letter_to_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for letter_title field
            //
            $column = new TextViewColumn('letter_title', 'letter_title', 'Letter Title', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'support_letter01Grid_letter_title_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for letter_to field
            //
            $column = new TextViewColumn('letter_to', 'letter_to', 'Letter To', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'support_letter01Grid_letter_to_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for letter_title field
            //
            $column = new TextViewColumn('letter_title', 'letter_title', 'Letter Title', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'support_letter01Grid_letter_title_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for letter_to field
            //
            $column = new TextViewColumn('letter_to', 'letter_to', 'Letter To', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'support_letter01Grid_letter_to_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for letter_title field
            //
            $column = new TextViewColumn('letter_title', 'letter_title', 'Letter Title', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'support_letter01Grid_letter_title_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`doctor`');
            $lookupDataset->addFields(
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
            $lookupDataset->setOrderByField('fullname', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_support_letter01_doctor_id_search', 'doctor_id', 'fullname', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`language`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('language_id', true, true, true),
                    new StringField('language')
                )
            );
            $lookupDataset->setOrderByField('language', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_support_letter01_language_id_search', 'language_id', 'language', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`doctor`');
            $lookupDataset->addFields(
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
            $lookupDataset->setOrderByField('fullname', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_support_letter01_doctor_id_search', 'doctor_id', 'fullname', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`doctor`');
            $lookupDataset->addFields(
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
            $lookupDataset->setOrderByField('fullname', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_support_letter01_doctor_id_search', 'doctor_id', 'fullname', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`language`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('language_id', true, true, true),
                    new StringField('language')
                )
            );
            $lookupDataset->setOrderByField('language', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_support_letter01_language_id_search', 'language_id', 'language', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for letter_to field
            //
            $column = new TextViewColumn('letter_to', 'letter_to', 'Letter To', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'support_letter01Grid_letter_to_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for letter_title field
            //
            $column = new TextViewColumn('letter_title', 'letter_title', 'Letter Title', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'support_letter01Grid_letter_title_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`doctor`');
            $lookupDataset->addFields(
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
            $lookupDataset->setOrderByField('fullname', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_support_letter01_doctor_id_search', 'doctor_id', 'fullname', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`language`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('language_id', true, true, true),
                    new StringField('language')
                )
            );
            $lookupDataset->setOrderByField('language', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_support_letter01_language_id_search', 'language_id', 'language', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`doctor`');
            $lookupDataset->addFields(
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
            $lookupDataset->setOrderByField('fullname', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_support_letter01_doctor_id_search', 'doctor_id', 'fullname', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`language`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('language_id', true, true, true),
                    new StringField('language')
                )
            );
            $lookupDataset->setOrderByField('language', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_support_letter01_language_id_search', 'language_id', 'language', null, 20);
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
        $Page = new support_letter01Page("support_letter01", "support_letter_ku_ar.php", GetCurrentUserPermissionSetForDataSource("support_letter01"), 'UTF-8');
        $Page->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource("support_letter01"));
        GetApplication()->SetMainPage($Page);
        GetApplication()->Run();
    }
    catch(Exception $e)
    {
        ShowErrorPage($e);
    }
	
