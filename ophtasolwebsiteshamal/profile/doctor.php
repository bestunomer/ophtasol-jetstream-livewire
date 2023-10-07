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
    
    
    
    class doctorPage extends Page
    {
        protected function DoBeforeCreate()
        {
            $this->SetTitle('Doctor');
            $this->SetMenuLabel('Doctor');
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
                new FilterColumn($this->dataset, 'doctor_id', 'doctor_id', 'Doctor Id'),
                new FilterColumn($this->dataset, 'doctor_photo', 'doctor_photo', 'Doctor Photo'),
                new FilterColumn($this->dataset, 'fullname', 'fullname', 'Fullname'),
                new FilterColumn($this->dataset, 'fullname_k', 'fullname_k', 'Fullname K'),
                new FilterColumn($this->dataset, 'fullname_a', 'fullname_a', 'Fullname A'),
                new FilterColumn($this->dataset, 'qualification', 'qualification', 'Qualification'),
                new FilterColumn($this->dataset, 'qualification_k', 'qualification_k', 'Qualification K'),
                new FilterColumn($this->dataset, 'qualification_a', 'qualification_a', 'Qualification A'),
                new FilterColumn($this->dataset, 'doctor_cat_id', 'doctor_cat_id_doctor_cat', 'Doctor Cat'),
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
                new FilterColumn($this->dataset, 'employment_cat_id', 'employment_cat_id_employment_cat_e', 'Employment Cat'),
                new FilterColumn($this->dataset, 'support_letter_download_counter', 'support_letter_download_counter', 'Support Letter Download Counter')
            );
        }
    
        protected function setupQuickFilter(QuickFilter $quickFilter, FixedKeysArray $columns)
        {
    
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
        }
    
        protected function AddFieldColumns(Grid $grid, $withDetails = true)
        {
            //
            // View column for doctor_photo field
            //
            $column = new ExternalImageViewColumn('doctor_photo', 'doctor_photo', 'Doctor Photo', $this->dataset);
            $column->SetOrderable(true);
            $column->setSourcePrefixTemplate('../../assets/img/doctors/');
            $column->setWidth('150px');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for fullname field
            //
            $column = new TextViewColumn('fullname', 'fullname', 'Fullname', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_fullname_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for fullname_k field
            //
            $column = new TextViewColumn('fullname_k', 'fullname_k', 'Fullname K', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_fullname_k_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for fullname_a field
            //
            $column = new TextViewColumn('fullname_a', 'fullname_a', 'Fullname A', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_fullname_a_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for qualification field
            //
            $column = new TextViewColumn('qualification', 'qualification', 'Qualification', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_qualification_handler_list');
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
            // View column for employment_cat_e field
            //
            $column = new TextViewColumn('employment_cat_id', 'employment_cat_id_employment_cat_e', 'Employment Cat', $this->dataset);
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
            $column = new ExternalImageViewColumn('doctor_photo', 'doctor_photo', 'Doctor Photo', $this->dataset);
            $column->SetOrderable(true);
            $column->setSourcePrefixTemplate('../../assets/img/doctors/');
            $column->setWidth('150px');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for fullname field
            //
            $column = new TextViewColumn('fullname', 'fullname', 'Fullname', $this->dataset);
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
            $column = new TextViewColumn('qualification', 'qualification', 'Qualification', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_qualification_handler_view');
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
            // View column for qualification_a field
            //
            $column = new TextViewColumn('qualification_a', 'qualification_a', 'Qualification A', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_qualification_a_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for doctor_cat field
            //
            $column = new TextViewColumn('doctor_cat_id', 'doctor_cat_id_doctor_cat', 'Doctor Cat', $this->dataset);
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
            // View column for detail_about_doctor field
            //
            $column = new TextViewColumn('detail_about_doctor', 'detail_about_doctor', 'Detail About Doctor', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_detail_about_doctor_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for detail_about_doctor_k field
            //
            $column = new TextViewColumn('detail_about_doctor_k', 'detail_about_doctor_k', 'Detail About Doctor K', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_detail_about_doctor_k_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for detail_about_doctor_a field
            //
            $column = new TextViewColumn('detail_about_doctor_a', 'detail_about_doctor_a', 'Detail About Doctor A', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_detail_about_doctor_a_handler_view');
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
            // View column for video_link field
            //
            $column = new TextViewColumn('video_link', 'video_link', 'Video Link', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_video_link_handler_view');
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
            $column = new TextViewColumn('employment_cat_id', 'employment_cat_id_employment_cat_e', 'Employment Cat', $this->dataset);
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
            $editColumn = new UploadFileToFolderColumn('Doctor Photo', 'doctor_photo', $editor, $this->dataset, false, false, '../../assets/img/doctors/', '%random%.%original_file_extension%', $this->OnFileUpload, true);
            $editColumn->SetReplaceUploadedFileIfExist(true);
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for fullname field
            //
            $editor = new TextEdit('fullname_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Fullname', 'fullname', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for fullname_k field
            //
            $editor = new TextEdit('fullname_k_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Fullname K', 'fullname_k', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for fullname_a field
            //
            $editor = new TextEdit('fullname_a_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Fullname A', 'fullname_a', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for qualification field
            //
            $editor = new TextEdit('qualification_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Qualification', 'qualification', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for qualification_k field
            //
            $editor = new TextEdit('qualification_k_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Qualification K', 'qualification_k', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for qualification_a field
            //
            $editor = new TextEdit('qualification_a_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Qualification A', 'qualification_a', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
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
            $editColumn = new DynamicLookupEditColumn('Doctor Cat', 'doctor_cat_id', 'doctor_cat_id_doctor_cat', 'edit_doctor_doctor_cat_id_search', $editor, $this->dataset, $lookupDataset, 'doctor_cat_id', 'doctor_cat', '');
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for work_email field
            //
            $editor = new TextEdit('work_email_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Work Email', 'work_email', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
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
            // Edit column for detail_about_doctor field
            //
            $editor = new TextAreaEdit('detail_about_doctor_edit', 50, 8);
            $editColumn = new CustomEditColumn('Detail About Doctor', 'detail_about_doctor', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for detail_about_doctor_k field
            //
            $editor = new TextAreaEdit('detail_about_doctor_k_edit', 50, 8);
            $editColumn = new CustomEditColumn('Detail About Doctor K', 'detail_about_doctor_k', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for detail_about_doctor_a field
            //
            $editor = new TextAreaEdit('detail_about_doctor_a_edit', 50, 8);
            $editColumn = new CustomEditColumn('Detail About Doctor A', 'detail_about_doctor_a', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for working_hours field
            //
            $editor = new TextEdit('working_hours_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Working Hours', 'working_hours', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for working_hours_k field
            //
            $editor = new TextEdit('working_hours_k_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Working Hours K', 'working_hours_k', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for working_hours_a field
            //
            $editor = new TextEdit('working_hours_a_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Working Hours A', 'working_hours_a', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for video_link field
            //
            $editor = new TextEdit('video_link_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Video Link', 'video_link', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
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
            $editColumn = new DynamicLookupEditColumn('Job Title', 'job_title_id', 'job_title_id_job_title_e', 'edit_doctor_job_title_id_search', $editor, $this->dataset, $lookupDataset, 'job_title_id', 'job_title_e', '');
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for first_employment_date field
            //
            $editor = new DateTimeEdit('first_employment_date_edit', false, 'd M y');
            $editColumn = new CustomEditColumn('First Employment Date', 'first_employment_date', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for salary_amount field
            //
            $editor = new TextEdit('salary_amount_edit');
            $editColumn = new CustomEditColumn('Salary Amount', 'salary_amount', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for date_of_birth field
            //
            $editor = new DateTimeEdit('date_of_birth_edit', false, 'd M y');
            $editColumn = new CustomEditColumn('Date Of Birth', 'date_of_birth', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
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
            $editColumn = new DynamicLookupEditColumn('Employment Cat', 'employment_cat_id', 'employment_cat_id_employment_cat_e', 'edit_doctor_employment_cat_id_search', $editor, $this->dataset, $lookupDataset, 'employment_cat_id', 'employment_cat_e', '');
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for support_letter_download_counter field
            //
            $editor = new TextEdit('support_letter_download_counter_edit');
            $editColumn = new CustomEditColumn('Support Letter Download Counter', 'support_letter_download_counter', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
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
            $editColumn = new UploadFileToFolderColumn('Doctor Photo', 'doctor_photo', $editor, $this->dataset, false, false, '../../assets/img/doctors/', '%random%.%original_file_extension%', $this->OnFileUpload, true);
            $editColumn->SetReplaceUploadedFileIfExist(true);
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for fullname field
            //
            $editor = new TextEdit('fullname_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Fullname', 'fullname', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for fullname_k field
            //
            $editor = new TextEdit('fullname_k_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Fullname K', 'fullname_k', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for fullname_a field
            //
            $editor = new TextEdit('fullname_a_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Fullname A', 'fullname_a', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for qualification field
            //
            $editor = new TextEdit('qualification_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Qualification', 'qualification', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for qualification_k field
            //
            $editor = new TextEdit('qualification_k_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Qualification K', 'qualification_k', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for qualification_a field
            //
            $editor = new TextEdit('qualification_a_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Qualification A', 'qualification_a', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
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
            $editColumn = new DynamicLookupEditColumn('Doctor Cat', 'doctor_cat_id', 'doctor_cat_id_doctor_cat', 'multi_edit_doctor_doctor_cat_id_search', $editor, $this->dataset, $lookupDataset, 'doctor_cat_id', 'doctor_cat', '');
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for work_email field
            //
            $editor = new TextEdit('work_email_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Work Email', 'work_email', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
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
            // Edit column for detail_about_doctor field
            //
            $editor = new TextAreaEdit('detail_about_doctor_edit', 50, 8);
            $editColumn = new CustomEditColumn('Detail About Doctor', 'detail_about_doctor', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for detail_about_doctor_k field
            //
            $editor = new TextAreaEdit('detail_about_doctor_k_edit', 50, 8);
            $editColumn = new CustomEditColumn('Detail About Doctor K', 'detail_about_doctor_k', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for detail_about_doctor_a field
            //
            $editor = new TextAreaEdit('detail_about_doctor_a_edit', 50, 8);
            $editColumn = new CustomEditColumn('Detail About Doctor A', 'detail_about_doctor_a', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for working_hours field
            //
            $editor = new TextEdit('working_hours_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Working Hours', 'working_hours', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for working_hours_k field
            //
            $editor = new TextEdit('working_hours_k_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Working Hours K', 'working_hours_k', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for working_hours_a field
            //
            $editor = new TextEdit('working_hours_a_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Working Hours A', 'working_hours_a', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for video_link field
            //
            $editor = new TextEdit('video_link_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Video Link', 'video_link', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
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
            $editColumn = new DynamicLookupEditColumn('Job Title', 'job_title_id', 'job_title_id_job_title_e', 'multi_edit_doctor_job_title_id_search', $editor, $this->dataset, $lookupDataset, 'job_title_id', 'job_title_e', '');
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for first_employment_date field
            //
            $editor = new DateTimeEdit('first_employment_date_edit', false, 'd M y');
            $editColumn = new CustomEditColumn('First Employment Date', 'first_employment_date', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for salary_amount field
            //
            $editor = new TextEdit('salary_amount_edit');
            $editColumn = new CustomEditColumn('Salary Amount', 'salary_amount', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for date_of_birth field
            //
            $editor = new DateTimeEdit('date_of_birth_edit', false, 'd M y');
            $editColumn = new CustomEditColumn('Date Of Birth', 'date_of_birth', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
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
            $editColumn = new DynamicLookupEditColumn('Employment Cat', 'employment_cat_id', 'employment_cat_id_employment_cat_e', 'multi_edit_doctor_employment_cat_id_search', $editor, $this->dataset, $lookupDataset, 'employment_cat_id', 'employment_cat_e', '');
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for support_letter_download_counter field
            //
            $editor = new TextEdit('support_letter_download_counter_edit');
            $editColumn = new CustomEditColumn('Support Letter Download Counter', 'support_letter_download_counter', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
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
            $editColumn = new UploadFileToFolderColumn('Doctor Photo', 'doctor_photo', $editor, $this->dataset, false, false, '../../assets/img/doctors/', '%random%.%original_file_extension%', $this->OnFileUpload, true);
            $editColumn->SetReplaceUploadedFileIfExist(true);
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for fullname field
            //
            $editor = new TextEdit('fullname_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Fullname', 'fullname', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for fullname_k field
            //
            $editor = new TextEdit('fullname_k_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Fullname K', 'fullname_k', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for fullname_a field
            //
            $editor = new TextEdit('fullname_a_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Fullname A', 'fullname_a', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for qualification field
            //
            $editor = new TextEdit('qualification_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Qualification', 'qualification', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for qualification_k field
            //
            $editor = new TextEdit('qualification_k_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Qualification K', 'qualification_k', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for qualification_a field
            //
            $editor = new TextEdit('qualification_a_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Qualification A', 'qualification_a', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
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
            $editColumn = new DynamicLookupEditColumn('Doctor Cat', 'doctor_cat_id', 'doctor_cat_id_doctor_cat', 'insert_doctor_doctor_cat_id_search', $editor, $this->dataset, $lookupDataset, 'doctor_cat_id', 'doctor_cat', '');
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for work_email field
            //
            $editor = new TextEdit('work_email_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Work Email', 'work_email', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
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
            // Edit column for detail_about_doctor field
            //
            $editor = new TextAreaEdit('detail_about_doctor_edit', 50, 8);
            $editColumn = new CustomEditColumn('Detail About Doctor', 'detail_about_doctor', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for detail_about_doctor_k field
            //
            $editor = new TextAreaEdit('detail_about_doctor_k_edit', 50, 8);
            $editColumn = new CustomEditColumn('Detail About Doctor K', 'detail_about_doctor_k', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for detail_about_doctor_a field
            //
            $editor = new TextAreaEdit('detail_about_doctor_a_edit', 50, 8);
            $editColumn = new CustomEditColumn('Detail About Doctor A', 'detail_about_doctor_a', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for working_hours field
            //
            $editor = new TextEdit('working_hours_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Working Hours', 'working_hours', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for working_hours_k field
            //
            $editor = new TextEdit('working_hours_k_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Working Hours K', 'working_hours_k', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for working_hours_a field
            //
            $editor = new TextEdit('working_hours_a_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Working Hours A', 'working_hours_a', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for video_link field
            //
            $editor = new TextEdit('video_link_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Video Link', 'video_link', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
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
            $editColumn = new DynamicLookupEditColumn('Job Title', 'job_title_id', 'job_title_id_job_title_e', 'insert_doctor_job_title_id_search', $editor, $this->dataset, $lookupDataset, 'job_title_id', 'job_title_e', '');
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for first_employment_date field
            //
            $editor = new DateTimeEdit('first_employment_date_edit', false, 'd M y');
            $editColumn = new CustomEditColumn('First Employment Date', 'first_employment_date', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for salary_amount field
            //
            $editor = new TextEdit('salary_amount_edit');
            $editColumn = new CustomEditColumn('Salary Amount', 'salary_amount', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for date_of_birth field
            //
            $editor = new DateTimeEdit('date_of_birth_edit', false, 'd M y');
            $editColumn = new CustomEditColumn('Date Of Birth', 'date_of_birth', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
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
            $editColumn = new DynamicLookupEditColumn('Employment Cat', 'employment_cat_id', 'employment_cat_id_employment_cat_e', 'insert_doctor_employment_cat_id_search', $editor, $this->dataset, $lookupDataset, 'employment_cat_id', 'employment_cat_e', '');
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for support_letter_download_counter field
            //
            $editor = new TextEdit('support_letter_download_counter_edit');
            $editColumn = new CustomEditColumn('Support Letter Download Counter', 'support_letter_download_counter', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            $grid->SetShowAddButton(false && $this->GetSecurityInfo()->HasAddGrant());
        }
    
        private function AddMultiUploadColumn(Grid $grid)
        {
    
        }
    
        protected function AddPrintColumns(Grid $grid)
        {
            //
            // View column for doctor_photo field
            //
            $column = new ExternalImageViewColumn('doctor_photo', 'doctor_photo', 'Doctor Photo', $this->dataset);
            $column->SetOrderable(true);
            $column->setSourcePrefixTemplate('../../assets/img/doctors/');
            $column->setWidth('150px');
            $grid->AddPrintColumn($column);
            
            //
            // View column for fullname field
            //
            $column = new TextViewColumn('fullname', 'fullname', 'Fullname', $this->dataset);
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
            $column = new TextViewColumn('qualification', 'qualification', 'Qualification', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_qualification_handler_print');
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
            // View column for qualification_a field
            //
            $column = new TextViewColumn('qualification_a', 'qualification_a', 'Qualification A', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_qualification_a_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for doctor_cat field
            //
            $column = new TextViewColumn('doctor_cat_id', 'doctor_cat_id_doctor_cat', 'Doctor Cat', $this->dataset);
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
            // View column for detail_about_doctor field
            //
            $column = new TextViewColumn('detail_about_doctor', 'detail_about_doctor', 'Detail About Doctor', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_detail_about_doctor_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for detail_about_doctor_k field
            //
            $column = new TextViewColumn('detail_about_doctor_k', 'detail_about_doctor_k', 'Detail About Doctor K', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_detail_about_doctor_k_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for detail_about_doctor_a field
            //
            $column = new TextViewColumn('detail_about_doctor_a', 'detail_about_doctor_a', 'Detail About Doctor A', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_detail_about_doctor_a_handler_print');
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
            // View column for video_link field
            //
            $column = new TextViewColumn('video_link', 'video_link', 'Video Link', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_video_link_handler_print');
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
            $column = new TextViewColumn('employment_cat_id', 'employment_cat_id_employment_cat_e', 'Employment Cat', $this->dataset);
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
            $column = new ExternalImageViewColumn('doctor_photo', 'doctor_photo', 'Doctor Photo', $this->dataset);
            $column->SetOrderable(true);
            $column->setSourcePrefixTemplate('../../assets/img/doctors/');
            $column->setWidth('150px');
            $grid->AddExportColumn($column);
            
            //
            // View column for fullname field
            //
            $column = new TextViewColumn('fullname', 'fullname', 'Fullname', $this->dataset);
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
            $column = new TextViewColumn('qualification', 'qualification', 'Qualification', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_qualification_handler_export');
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
            // View column for qualification_a field
            //
            $column = new TextViewColumn('qualification_a', 'qualification_a', 'Qualification A', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_qualification_a_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for doctor_cat field
            //
            $column = new TextViewColumn('doctor_cat_id', 'doctor_cat_id_doctor_cat', 'Doctor Cat', $this->dataset);
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
            // View column for detail_about_doctor field
            //
            $column = new TextViewColumn('detail_about_doctor', 'detail_about_doctor', 'Detail About Doctor', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_detail_about_doctor_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for detail_about_doctor_k field
            //
            $column = new TextViewColumn('detail_about_doctor_k', 'detail_about_doctor_k', 'Detail About Doctor K', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_detail_about_doctor_k_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for detail_about_doctor_a field
            //
            $column = new TextViewColumn('detail_about_doctor_a', 'detail_about_doctor_a', 'Detail About Doctor A', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_detail_about_doctor_a_handler_export');
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
            // View column for video_link field
            //
            $column = new TextViewColumn('video_link', 'video_link', 'Video Link', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_video_link_handler_export');
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
            $column = new TextViewColumn('employment_cat_id', 'employment_cat_id_employment_cat_e', 'Employment Cat', $this->dataset);
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
            $column = new ExternalImageViewColumn('doctor_photo', 'doctor_photo', 'Doctor Photo', $this->dataset);
            $column->SetOrderable(true);
            $column->setSourcePrefixTemplate('../../assets/img/doctors/');
            $column->setWidth('150px');
            $grid->AddCompareColumn($column);
            
            //
            // View column for fullname field
            //
            $column = new TextViewColumn('fullname', 'fullname', 'Fullname', $this->dataset);
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
            $column = new TextViewColumn('qualification', 'qualification', 'Qualification', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_qualification_handler_compare');
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
            // View column for qualification_a field
            //
            $column = new TextViewColumn('qualification_a', 'qualification_a', 'Qualification A', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_qualification_a_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for doctor_cat field
            //
            $column = new TextViewColumn('doctor_cat_id', 'doctor_cat_id_doctor_cat', 'Doctor Cat', $this->dataset);
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
            // View column for detail_about_doctor field
            //
            $column = new TextViewColumn('detail_about_doctor', 'detail_about_doctor', 'Detail About Doctor', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_detail_about_doctor_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for detail_about_doctor_k field
            //
            $column = new TextViewColumn('detail_about_doctor_k', 'detail_about_doctor_k', 'Detail About Doctor K', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_detail_about_doctor_k_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for detail_about_doctor_a field
            //
            $column = new TextViewColumn('detail_about_doctor_a', 'detail_about_doctor_a', 'Detail About Doctor A', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_detail_about_doctor_a_handler_compare');
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
            // View column for video_link field
            //
            $column = new TextViewColumn('video_link', 'video_link', 'Video Link', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('doctorGrid_video_link_handler_compare');
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
            $column = new TextViewColumn('employment_cat_id', 'employment_cat_id_employment_cat_e', 'Employment Cat', $this->dataset);
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
    
        function GetCustomClientScript()
        {
            return ;
        }
        
        function GetOnPageLoadedClientScript()
        {
            return ;
        }
        public function GetEnableModalSingleRecordView() { return true; }
    
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
            $this->setPrintListRecordAvailable(true);
            $this->setPrintOneRecordAvailable(false);
            $this->setAllowPrintSelectedRecords(false);
            $this->setExportListAvailable(array());
            $this->setExportSelectedRecordsAvailable(array());
            $this->setExportListRecordAvailable(array('pdf'));
            $this->setExportOneRecordAvailable(array());
    
            return $result;
        }
     
        protected function setClientSideEvents(Grid $grid) {
    
        }
    
        protected function doRegisterHandlers() {
            //
            // View column for fullname field
            //
            $column = new TextViewColumn('fullname', 'fullname', 'Fullname', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'doctorGrid_fullname_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for fullname_k field
            //
            $column = new TextViewColumn('fullname_k', 'fullname_k', 'Fullname K', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'doctorGrid_fullname_k_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for fullname_a field
            //
            $column = new TextViewColumn('fullname_a', 'fullname_a', 'Fullname A', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'doctorGrid_fullname_a_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for qualification field
            //
            $column = new TextViewColumn('qualification', 'qualification', 'Qualification', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'doctorGrid_qualification_handler_list', $column);
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
            // View column for fullname field
            //
            $column = new TextViewColumn('fullname', 'fullname', 'Fullname', $this->dataset);
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
            $column = new TextViewColumn('qualification', 'qualification', 'Qualification', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'doctorGrid_qualification_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for qualification_k field
            //
            $column = new TextViewColumn('qualification_k', 'qualification_k', 'Qualification K', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'doctorGrid_qualification_k_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for qualification_a field
            //
            $column = new TextViewColumn('qualification_a', 'qualification_a', 'Qualification A', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'doctorGrid_qualification_a_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for doctor_cat field
            //
            $column = new TextViewColumn('doctor_cat_id', 'doctor_cat_id_doctor_cat', 'Doctor Cat', $this->dataset);
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
            // View column for detail_about_doctor field
            //
            $column = new TextViewColumn('detail_about_doctor', 'detail_about_doctor', 'Detail About Doctor', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'doctorGrid_detail_about_doctor_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for detail_about_doctor_k field
            //
            $column = new TextViewColumn('detail_about_doctor_k', 'detail_about_doctor_k', 'Detail About Doctor K', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'doctorGrid_detail_about_doctor_k_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for detail_about_doctor_a field
            //
            $column = new TextViewColumn('detail_about_doctor_a', 'detail_about_doctor_a', 'Detail About Doctor A', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'doctorGrid_detail_about_doctor_a_handler_print', $column);
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
            // View column for video_link field
            //
            $column = new TextViewColumn('video_link', 'video_link', 'Video Link', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'doctorGrid_video_link_handler_print', $column);
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
            $column = new TextViewColumn('fullname', 'fullname', 'Fullname', $this->dataset);
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
            $column = new TextViewColumn('qualification', 'qualification', 'Qualification', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'doctorGrid_qualification_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for qualification_k field
            //
            $column = new TextViewColumn('qualification_k', 'qualification_k', 'Qualification K', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'doctorGrid_qualification_k_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for qualification_a field
            //
            $column = new TextViewColumn('qualification_a', 'qualification_a', 'Qualification A', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'doctorGrid_qualification_a_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for doctor_cat field
            //
            $column = new TextViewColumn('doctor_cat_id', 'doctor_cat_id_doctor_cat', 'Doctor Cat', $this->dataset);
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
            // View column for detail_about_doctor field
            //
            $column = new TextViewColumn('detail_about_doctor', 'detail_about_doctor', 'Detail About Doctor', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'doctorGrid_detail_about_doctor_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for detail_about_doctor_k field
            //
            $column = new TextViewColumn('detail_about_doctor_k', 'detail_about_doctor_k', 'Detail About Doctor K', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'doctorGrid_detail_about_doctor_k_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for detail_about_doctor_a field
            //
            $column = new TextViewColumn('detail_about_doctor_a', 'detail_about_doctor_a', 'Detail About Doctor A', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'doctorGrid_detail_about_doctor_a_handler_compare', $column);
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
            // View column for video_link field
            //
            $column = new TextViewColumn('video_link', 'video_link', 'Video Link', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'doctorGrid_video_link_handler_compare', $column);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_doctor_doctor_cat_id_search', 'doctor_cat_id', 'doctor_cat', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_doctor_job_title_id_search', 'job_title_id', 'job_title_e', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_doctor_employment_cat_id_search', 'employment_cat_id', 'employment_cat_e', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for fullname field
            //
            $column = new TextViewColumn('fullname', 'fullname', 'Fullname', $this->dataset);
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
            $column = new TextViewColumn('qualification', 'qualification', 'Qualification', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'doctorGrid_qualification_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for qualification_k field
            //
            $column = new TextViewColumn('qualification_k', 'qualification_k', 'Qualification K', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'doctorGrid_qualification_k_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for qualification_a field
            //
            $column = new TextViewColumn('qualification_a', 'qualification_a', 'Qualification A', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'doctorGrid_qualification_a_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for doctor_cat field
            //
            $column = new TextViewColumn('doctor_cat_id', 'doctor_cat_id_doctor_cat', 'Doctor Cat', $this->dataset);
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
            // View column for detail_about_doctor field
            //
            $column = new TextViewColumn('detail_about_doctor', 'detail_about_doctor', 'Detail About Doctor', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'doctorGrid_detail_about_doctor_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for detail_about_doctor_k field
            //
            $column = new TextViewColumn('detail_about_doctor_k', 'detail_about_doctor_k', 'Detail About Doctor K', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'doctorGrid_detail_about_doctor_k_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for detail_about_doctor_a field
            //
            $column = new TextViewColumn('detail_about_doctor_a', 'detail_about_doctor_a', 'Detail About Doctor A', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'doctorGrid_detail_about_doctor_a_handler_view', $column);
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
            // View column for video_link field
            //
            $column = new TextViewColumn('video_link', 'video_link', 'Video Link', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'doctorGrid_video_link_handler_view', $column);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_doctor_doctor_cat_id_search', 'doctor_cat_id', 'doctor_cat', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_doctor_job_title_id_search', 'job_title_id', 'job_title_e', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_doctor_employment_cat_id_search', 'employment_cat_id', 'employment_cat_e', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_doctor_doctor_cat_id_search', 'doctor_cat_id', 'doctor_cat', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_doctor_job_title_id_search', 'job_title_id', 'job_title_e', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_doctor_employment_cat_id_search', 'employment_cat_id', 'employment_cat_e', null, 20);
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
        $Page = new doctorPage("doctor", "doctor.php", GetCurrentUserPermissionSetForDataSource("doctor"), 'UTF-8');
        $Page->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource("doctor"));
        GetApplication()->SetMainPage($Page);
        GetApplication()->Run();
    }
    catch(Exception $e)
    {
        ShowErrorPage($e);
    }
	
