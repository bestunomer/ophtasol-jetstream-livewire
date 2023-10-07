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
    
    
    
    class support_letterPage extends Page
    {
        protected function DoBeforeCreate()
        {
            $this->SetTitle('Support Letter');
            $this->SetMenuLabel('Support Letter');
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
            if (!$this->GetSecurityInfo()->HasAdminGrant()) {
                $this->dataset->setRlsPolicy(new RlsPolicy('doctor_id', GetApplication()->GetCurrentUserId()));
            }
        }
    
        protected function DoPrepare() {
    
        }
    
        protected function CreatePageNavigator()
        {
            return null;
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
                new FilterColumn($this->dataset, 'doctor_id', 'doctor_id_fullname', 'Request by'),
                new FilterColumn($this->dataset, 'letter_to', 'letter_to', 'Letter To'),
                new FilterColumn($this->dataset, 'letter_title', 'letter_title', 'Letter Title'),
                new FilterColumn($this->dataset, 'language_id', 'language_id_language', 'Language')
            );
        }
    
        protected function setupQuickFilter(QuickFilter $quickFilter, FixedKeysArray $columns)
        {
            $quickFilter
                ->addColumn($columns['support_id'])
                ->addColumn($columns['support_request_date'])
                ->addColumn($columns['doctor_id'])
                ->addColumn($columns['letter_to'])
                ->addColumn($columns['letter_title'])
                ->addColumn($columns['language_id']);
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
            // View column for support_id field
            //
            $column = new NumberViewColumn('support_id', 'support_id', 'Support Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for support_request_date field
            //
            $column = new DateTimeViewColumn('support_request_date', 'support_request_date', 'Support Request Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d M y');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for fullname field
            //
            $column = new TextViewColumn('doctor_id', 'doctor_id_fullname', 'Request by', $this->dataset);
            $column->SetOrderable(true);
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
            $column->SetFullTextWindowHandlerName('support_letterGrid_letter_to_handler_list');
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
            $column->SetFullTextWindowHandlerName('support_letterGrid_letter_title_handler_list');
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
            // View column for support_id field
            //
            $column = new NumberViewColumn('support_id', 'support_id', 'Support Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for support_request_date field
            //
            $column = new DateTimeViewColumn('support_request_date', 'support_request_date', 'Support Request Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d M y');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for fullname field
            //
            $column = new TextViewColumn('doctor_id', 'doctor_id_fullname', 'Request by', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for letter_to field
            //
            $column = new TextViewColumn('letter_to', 'letter_to', 'Letter To', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('support_letterGrid_letter_to_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for letter_title field
            //
            $column = new TextViewColumn('letter_title', 'letter_title', 'Letter Title', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('support_letterGrid_letter_title_handler_view');
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
            $editor = new DateTimeEdit('support_request_date_edit', false, 'd M y');
            $editColumn = new CustomEditColumn('Support Request Date', 'support_request_date', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
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
            $editColumn = new DynamicLookupEditColumn('Request by', 'doctor_id', 'doctor_id_fullname', 'edit_support_letter_doctor_id_search', $editor, $this->dataset, $lookupDataset, 'doctor_id', 'fullname', '');
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
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for letter_title field
            //
            $editor = new TextEdit('letter_title_edit');
            $editColumn = new CustomEditColumn('Letter Title', 'letter_title', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for language_id field
            //
            $editor = new ComboBox('language_id_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
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
            $editColumn = new LookUpEditColumn(
                'Language', 
                'language_id', 
                $editor, 
                $this->dataset, 'language_id', 'language', $lookupDataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
        }
    
        protected function AddMultiEditColumns(Grid $grid)
        {
            //
            // Edit column for support_request_date field
            //
            $editor = new DateTimeEdit('support_request_date_edit', false, 'd M y');
            $editColumn = new CustomEditColumn('Support Request Date', 'support_request_date', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
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
            $editColumn = new DynamicLookupEditColumn('Request by', 'doctor_id', 'doctor_id_fullname', 'multi_edit_support_letter_doctor_id_search', $editor, $this->dataset, $lookupDataset, 'doctor_id', 'fullname', '');
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
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for letter_title field
            //
            $editor = new TextEdit('letter_title_edit');
            $editColumn = new CustomEditColumn('Letter Title', 'letter_title', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for language_id field
            //
            $editor = new ComboBox('language_id_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
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
            $editColumn = new LookUpEditColumn(
                'Language', 
                'language_id', 
                $editor, 
                $this->dataset, 'language_id', 'language', $lookupDataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
        }
    
        protected function AddInsertColumns(Grid $grid)
        {
            //
            // Edit column for support_request_date field
            //
            $editor = new DateTimeEdit('support_request_date_edit', false, 'd M y');
            $editColumn = new CustomEditColumn('Support Request Date', 'support_request_date', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $editColumn->SetInsertDefaultValue('%CURRENT_DATETIME%');
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
            $editColumn = new DynamicLookupEditColumn('Request by', 'doctor_id', 'doctor_id_fullname', 'insert_support_letter_doctor_id_search', $editor, $this->dataset, $lookupDataset, 'doctor_id', 'fullname', '');
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $editColumn->SetInsertDefaultValue('%CURRENT_USER_ID%');
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for letter_to field
            //
            $editor = new TextEdit('letter_to_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Letter To', 'letter_to', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for letter_title field
            //
            $editor = new TextEdit('letter_title_edit');
            $editColumn = new CustomEditColumn('Letter Title', 'letter_title', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for language_id field
            //
            $editor = new ComboBox('language_id_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
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
            $editColumn = new LookUpEditColumn(
                'Language', 
                'language_id', 
                $editor, 
                $this->dataset, 'language_id', 'language', $lookupDataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
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
            // View column for support_id field
            //
            $column = new NumberViewColumn('support_id', 'support_id', 'Support Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for support_request_date field
            //
            $column = new DateTimeViewColumn('support_request_date', 'support_request_date', 'Support Request Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d M y');
            $grid->AddPrintColumn($column);
            
            //
            // View column for fullname field
            //
            $column = new TextViewColumn('doctor_id', 'doctor_id_fullname', 'Request by', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for letter_to field
            //
            $column = new TextViewColumn('letter_to', 'letter_to', 'Letter To', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('support_letterGrid_letter_to_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for letter_title field
            //
            $column = new TextViewColumn('letter_title', 'letter_title', 'Letter Title', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('support_letterGrid_letter_title_handler_print');
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
            // View column for support_id field
            //
            $column = new NumberViewColumn('support_id', 'support_id', 'Support Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for support_request_date field
            //
            $column = new DateTimeViewColumn('support_request_date', 'support_request_date', 'Support Request Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d M y');
            $grid->AddExportColumn($column);
            
            //
            // View column for fullname field
            //
            $column = new TextViewColumn('doctor_id', 'doctor_id_fullname', 'Request by', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for letter_to field
            //
            $column = new TextViewColumn('letter_to', 'letter_to', 'Letter To', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('support_letterGrid_letter_to_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for letter_title field
            //
            $column = new TextViewColumn('letter_title', 'letter_title', 'Letter Title', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('support_letterGrid_letter_title_handler_export');
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
            $column->SetDateTimeFormat('d M y');
            $grid->AddCompareColumn($column);
            
            //
            // View column for fullname field
            //
            $column = new TextViewColumn('doctor_id', 'doctor_id_fullname', 'Request by', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for letter_to field
            //
            $column = new TextViewColumn('letter_to', 'letter_to', 'Letter To', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('support_letterGrid_letter_to_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for letter_title field
            //
            $column = new TextViewColumn('letter_title', 'letter_title', 'Letter Title', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('support_letterGrid_letter_title_handler_compare');
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
            $this->SetShowTopPageNavigator(false);
            $this->SetShowBottomPageNavigator(false);
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
            // View column for letter_to field
            //
            $column = new TextViewColumn('letter_to', 'letter_to', 'Letter To', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'support_letterGrid_letter_to_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for letter_title field
            //
            $column = new TextViewColumn('letter_title', 'letter_title', 'Letter Title', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'support_letterGrid_letter_title_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for letter_to field
            //
            $column = new TextViewColumn('letter_to', 'letter_to', 'Letter To', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'support_letterGrid_letter_to_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for letter_title field
            //
            $column = new TextViewColumn('letter_title', 'letter_title', 'Letter Title', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'support_letterGrid_letter_title_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for letter_to field
            //
            $column = new TextViewColumn('letter_to', 'letter_to', 'Letter To', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'support_letterGrid_letter_to_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for letter_title field
            //
            $column = new TextViewColumn('letter_title', 'letter_title', 'Letter Title', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'support_letterGrid_letter_title_handler_compare', $column);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_support_letter_doctor_id_search', 'doctor_id', 'fullname', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for letter_to field
            //
            $column = new TextViewColumn('letter_to', 'letter_to', 'Letter To', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'support_letterGrid_letter_to_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for letter_title field
            //
            $column = new TextViewColumn('letter_title', 'letter_title', 'Letter Title', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'support_letterGrid_letter_title_handler_view', $column);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_support_letter_doctor_id_search', 'doctor_id', 'fullname', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_support_letter_doctor_id_search', 'doctor_id', 'fullname', null, 20);
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
        $Page = new support_letterPage("support_letter", "support_letter.php", GetCurrentUserPermissionSetForDataSource("support_letter"), 'UTF-8');
        $Page->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource("support_letter"));
        GetApplication()->SetMainPage($Page);
        GetApplication()->Run();
    }
    catch(Exception $e)
    {
        ShowErrorPage($e);
    }
	
