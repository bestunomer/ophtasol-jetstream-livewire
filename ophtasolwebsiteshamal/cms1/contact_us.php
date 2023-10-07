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
    
    
    
    class contact_usPage extends Page
    {
        protected function DoBeforeCreate()
        {
            $this->SetTitle('Contact Us');
            $this->SetMenuLabel('Contact Us');
            $this->SetHeader(GetPagesHeader());
            $this->SetFooter(GetPagesFooter());
    
            $this->dataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`contact_us`');
            $this->dataset->addFields(
                array(
                    new IntegerField('contact_id', true, true, true),
                    new StringField('title'),
                    new StringField('detail'),
                    new StringField('photo'),
                    new StringField('hospital_logo'),
                    new StringField('video'),
                    new StringField('working_hours'),
                    new StringField('address'),
                    new StringField('mobile1'),
                    new StringField('mobile2'),
                    new StringField('google_map'),
                    new StringField('email'),
                    new StringField('facebook'),
                    new StringField('youtube'),
                    new StringField('instagram'),
                    new IntegerField('publish_id'),
                    new IntegerField('language_id')
                )
            );
            $this->dataset->AddLookupField('publish_id', 'publish', new IntegerField('publish_id'), new StringField('publish_title', false, false, false, false, 'publish_id_publish_title', 'publish_id_publish_title_publish'), 'publish_id_publish_title_publish');
            $this->dataset->AddLookupField('language_id', 'language', new IntegerField('language_id'), new StringField('language', false, false, false, false, 'language_id_language', 'language_id_language_language'), 'language_id_language_language');
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
                new FilterColumn($this->dataset, 'contact_id', 'contact_id', 'Contact Id'),
                new FilterColumn($this->dataset, 'title', 'title', 'Title'),
                new FilterColumn($this->dataset, 'detail', 'detail', 'Detail'),
                new FilterColumn($this->dataset, 'photo', 'photo', 'Photo'),
                new FilterColumn($this->dataset, 'hospital_logo', 'hospital_logo', 'Hospital Logo'),
                new FilterColumn($this->dataset, 'video', 'video', 'Video'),
                new FilterColumn($this->dataset, 'working_hours', 'working_hours', 'Working Hours'),
                new FilterColumn($this->dataset, 'mobile1', 'mobile1', 'Mobile1'),
                new FilterColumn($this->dataset, 'mobile2', 'mobile2', 'Mobile2'),
                new FilterColumn($this->dataset, 'google_map', 'google_map', 'Google Map'),
                new FilterColumn($this->dataset, 'email', 'email', 'Email'),
                new FilterColumn($this->dataset, 'facebook', 'facebook', 'Facebook'),
                new FilterColumn($this->dataset, 'youtube', 'youtube', 'Youtube'),
                new FilterColumn($this->dataset, 'instagram', 'instagram', 'Instagram'),
                new FilterColumn($this->dataset, 'publish_id', 'publish_id_publish_title', 'Publish'),
                new FilterColumn($this->dataset, 'language_id', 'language_id_language', 'Language'),
                new FilterColumn($this->dataset, 'address', 'address', 'Address')
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
                $operation = new AjaxOperation(OPERATION_EDIT,
                    $this->GetLocalizerCaptions()->GetMessageString('Edit'),
                    $this->GetLocalizerCaptions()->GetMessageString('Edit'), $this->dataset,
                    $this->GetGridEditHandler(), $grid);
                $operation->setUseImage(false);
                $actions->addOperation($operation);
                $operation->OnShow->AddListener('ShowEditButtonHandler', $this);
            }
        }
    
        protected function AddFieldColumns(Grid $grid, $withDetails = true)
        {
            //
            // View column for title field
            //
            $column = new TextViewColumn('title', 'title', 'Title', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('contact_usGrid_title_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for mobile1 field
            //
            $column = new TextViewColumn('mobile1', 'mobile1', 'Mobile1', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('contact_usGrid_mobile1_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for mobile2 field
            //
            $column = new TextViewColumn('mobile2', 'mobile2', 'Mobile2', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('contact_usGrid_mobile2_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for email field
            //
            $column = new TextViewColumn('email', 'email', 'Email', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('contact_usGrid_email_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for publish_title field
            //
            $column = new TextViewColumn('publish_id', 'publish_id_publish_title', 'Publish', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('contact_usGrid_publish_id_publish_title_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for language field
            //
            $column = new TextViewColumn('language_id', 'language_id_language', 'Language', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('contact_usGrid_language_id_language_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for address field
            //
            $column = new TextViewColumn('address', 'address', 'Address', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('contact_usGrid_address_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
        }
    
        protected function AddSingleRecordViewColumns(Grid $grid)
        {
            //
            // View column for title field
            //
            $column = new TextViewColumn('title', 'title', 'Title', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('contact_usGrid_title_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for detail field
            //
            $column = new TextViewColumn('detail', 'detail', 'Detail', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('contact_usGrid_detail_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for video field
            //
            $column = new TextViewColumn('video', 'video', 'Video', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('contact_usGrid_video_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for working_hours field
            //
            $column = new TextViewColumn('working_hours', 'working_hours', 'Working Hours', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('contact_usGrid_working_hours_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for mobile1 field
            //
            $column = new TextViewColumn('mobile1', 'mobile1', 'Mobile1', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('contact_usGrid_mobile1_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for mobile2 field
            //
            $column = new TextViewColumn('mobile2', 'mobile2', 'Mobile2', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('contact_usGrid_mobile2_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for google_map field
            //
            $column = new TextViewColumn('google_map', 'google_map', 'Google Map', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('contact_usGrid_google_map_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for email field
            //
            $column = new TextViewColumn('email', 'email', 'Email', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('contact_usGrid_email_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for facebook field
            //
            $column = new TextViewColumn('facebook', 'facebook', 'Facebook', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('contact_usGrid_facebook_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for youtube field
            //
            $column = new TextViewColumn('youtube', 'youtube', 'Youtube', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('contact_usGrid_youtube_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for instagram field
            //
            $column = new TextViewColumn('instagram', 'instagram', 'Instagram', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('contact_usGrid_instagram_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for publish_title field
            //
            $column = new TextViewColumn('publish_id', 'publish_id_publish_title', 'Publish', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('contact_usGrid_publish_id_publish_title_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for language field
            //
            $column = new TextViewColumn('language_id', 'language_id_language', 'Language', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('contact_usGrid_language_id_language_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for address field
            //
            $column = new TextViewColumn('address', 'address', 'Address', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('contact_usGrid_address_handler_view');
            $grid->AddSingleRecordViewColumn($column);
        }
    
        protected function AddEditColumns(Grid $grid)
        {
            //
            // Edit column for title field
            //
            $editor = new TextEdit('title_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Title', 'title', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for detail field
            //
            $editor = new TextAreaEdit('detail_edit', 50, 8);
            $editColumn = new CustomEditColumn('Detail', 'detail', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for video field
            //
            $editor = new TextEdit('video_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Video', 'video', $editor, $this->dataset);
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
            // Edit column for mobile1 field
            //
            $editor = new TextEdit('mobile1_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Mobile1', 'mobile1', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for mobile2 field
            //
            $editor = new TextEdit('mobile2_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Mobile2', 'mobile2', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for google_map field
            //
            $editor = new TextAreaEdit('google_map_edit', 50, 8);
            $editColumn = new CustomEditColumn('Google Map', 'google_map', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for email field
            //
            $editor = new TextEdit('email_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Email', 'email', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for facebook field
            //
            $editor = new TextEdit('facebook_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Facebook', 'facebook', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for youtube field
            //
            $editor = new TextEdit('youtube_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Youtube', 'youtube', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for instagram field
            //
            $editor = new TextEdit('instagram_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Instagram', 'instagram', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for publish_id field
            //
            $editor = new DynamicCombobox('publish_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`publish`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('publish_id', true, true, true),
                    new StringField('publish_title')
                )
            );
            $lookupDataset->setOrderByField('publish_title', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Publish', 'publish_id', 'publish_id_publish_title', 'edit_contact_us_publish_id_search', $editor, $this->dataset, $lookupDataset, 'publish_id', 'publish_title', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
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
            $editColumn = new DynamicLookupEditColumn('Language', 'language_id', 'language_id_language', 'edit_contact_us_language_id_search', $editor, $this->dataset, $lookupDataset, 'language_id', 'language', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for address field
            //
            $editor = new TextEdit('address_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Address', 'address', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
        }
    
        protected function AddMultiEditColumns(Grid $grid)
        {
            //
            // Edit column for title field
            //
            $editor = new TextEdit('title_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Title', 'title', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for detail field
            //
            $editor = new TextAreaEdit('detail_edit', 50, 8);
            $editColumn = new CustomEditColumn('Detail', 'detail', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for video field
            //
            $editor = new TextEdit('video_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Video', 'video', $editor, $this->dataset);
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
            // Edit column for mobile1 field
            //
            $editor = new TextEdit('mobile1_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Mobile1', 'mobile1', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for mobile2 field
            //
            $editor = new TextEdit('mobile2_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Mobile2', 'mobile2', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for google_map field
            //
            $editor = new TextAreaEdit('google_map_edit', 50, 8);
            $editColumn = new CustomEditColumn('Google Map', 'google_map', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for email field
            //
            $editor = new TextEdit('email_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Email', 'email', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for facebook field
            //
            $editor = new TextEdit('facebook_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Facebook', 'facebook', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for youtube field
            //
            $editor = new TextEdit('youtube_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Youtube', 'youtube', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for instagram field
            //
            $editor = new TextEdit('instagram_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Instagram', 'instagram', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for publish_id field
            //
            $editor = new DynamicCombobox('publish_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`publish`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('publish_id', true, true, true),
                    new StringField('publish_title')
                )
            );
            $lookupDataset->setOrderByField('publish_title', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Publish', 'publish_id', 'publish_id_publish_title', 'multi_edit_contact_us_publish_id_search', $editor, $this->dataset, $lookupDataset, 'publish_id', 'publish_title', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
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
            $editColumn = new DynamicLookupEditColumn('Language', 'language_id', 'language_id_language', 'multi_edit_contact_us_language_id_search', $editor, $this->dataset, $lookupDataset, 'language_id', 'language', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for address field
            //
            $editor = new TextEdit('address_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Address', 'address', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
        }
    
        protected function AddInsertColumns(Grid $grid)
        {
            //
            // Edit column for title field
            //
            $editor = new TextEdit('title_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Title', 'title', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for detail field
            //
            $editor = new TextAreaEdit('detail_edit', 50, 8);
            $editColumn = new CustomEditColumn('Detail', 'detail', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for video field
            //
            $editor = new TextEdit('video_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Video', 'video', $editor, $this->dataset);
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
            // Edit column for mobile1 field
            //
            $editor = new TextEdit('mobile1_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Mobile1', 'mobile1', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for mobile2 field
            //
            $editor = new TextEdit('mobile2_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Mobile2', 'mobile2', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for google_map field
            //
            $editor = new TextAreaEdit('google_map_edit', 50, 8);
            $editColumn = new CustomEditColumn('Google Map', 'google_map', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for email field
            //
            $editor = new TextEdit('email_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Email', 'email', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for facebook field
            //
            $editor = new TextEdit('facebook_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Facebook', 'facebook', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for youtube field
            //
            $editor = new TextEdit('youtube_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Youtube', 'youtube', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for instagram field
            //
            $editor = new TextEdit('instagram_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Instagram', 'instagram', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for publish_id field
            //
            $editor = new DynamicCombobox('publish_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`publish`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('publish_id', true, true, true),
                    new StringField('publish_title')
                )
            );
            $lookupDataset->setOrderByField('publish_title', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Publish', 'publish_id', 'publish_id_publish_title', 'insert_contact_us_publish_id_search', $editor, $this->dataset, $lookupDataset, 'publish_id', 'publish_title', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
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
            $editColumn = new DynamicLookupEditColumn('Language', 'language_id', 'language_id_language', 'insert_contact_us_language_id_search', $editor, $this->dataset, $lookupDataset, 'language_id', 'language', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for address field
            //
            $editor = new TextEdit('address_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Address', 'address', $editor, $this->dataset);
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
            // View column for title field
            //
            $column = new TextViewColumn('title', 'title', 'Title', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('contact_usGrid_title_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for detail field
            //
            $column = new TextViewColumn('detail', 'detail', 'Detail', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('contact_usGrid_detail_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for video field
            //
            $column = new TextViewColumn('video', 'video', 'Video', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('contact_usGrid_video_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for working_hours field
            //
            $column = new TextViewColumn('working_hours', 'working_hours', 'Working Hours', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('contact_usGrid_working_hours_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for mobile1 field
            //
            $column = new TextViewColumn('mobile1', 'mobile1', 'Mobile1', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('contact_usGrid_mobile1_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for mobile2 field
            //
            $column = new TextViewColumn('mobile2', 'mobile2', 'Mobile2', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('contact_usGrid_mobile2_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for google_map field
            //
            $column = new TextViewColumn('google_map', 'google_map', 'Google Map', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('contact_usGrid_google_map_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for email field
            //
            $column = new TextViewColumn('email', 'email', 'Email', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('contact_usGrid_email_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for facebook field
            //
            $column = new TextViewColumn('facebook', 'facebook', 'Facebook', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('contact_usGrid_facebook_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for youtube field
            //
            $column = new TextViewColumn('youtube', 'youtube', 'Youtube', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('contact_usGrid_youtube_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for instagram field
            //
            $column = new TextViewColumn('instagram', 'instagram', 'Instagram', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('contact_usGrid_instagram_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for publish_title field
            //
            $column = new TextViewColumn('publish_id', 'publish_id_publish_title', 'Publish', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('contact_usGrid_publish_id_publish_title_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for language field
            //
            $column = new TextViewColumn('language_id', 'language_id_language', 'Language', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('contact_usGrid_language_id_language_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for address field
            //
            $column = new TextViewColumn('address', 'address', 'Address', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('contact_usGrid_address_handler_print');
            $grid->AddPrintColumn($column);
        }
    
        protected function AddExportColumns(Grid $grid)
        {
            //
            // View column for title field
            //
            $column = new TextViewColumn('title', 'title', 'Title', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('contact_usGrid_title_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for detail field
            //
            $column = new TextViewColumn('detail', 'detail', 'Detail', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('contact_usGrid_detail_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for video field
            //
            $column = new TextViewColumn('video', 'video', 'Video', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('contact_usGrid_video_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for working_hours field
            //
            $column = new TextViewColumn('working_hours', 'working_hours', 'Working Hours', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('contact_usGrid_working_hours_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for mobile1 field
            //
            $column = new TextViewColumn('mobile1', 'mobile1', 'Mobile1', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('contact_usGrid_mobile1_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for mobile2 field
            //
            $column = new TextViewColumn('mobile2', 'mobile2', 'Mobile2', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('contact_usGrid_mobile2_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for google_map field
            //
            $column = new TextViewColumn('google_map', 'google_map', 'Google Map', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('contact_usGrid_google_map_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for email field
            //
            $column = new TextViewColumn('email', 'email', 'Email', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('contact_usGrid_email_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for facebook field
            //
            $column = new TextViewColumn('facebook', 'facebook', 'Facebook', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('contact_usGrid_facebook_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for youtube field
            //
            $column = new TextViewColumn('youtube', 'youtube', 'Youtube', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('contact_usGrid_youtube_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for instagram field
            //
            $column = new TextViewColumn('instagram', 'instagram', 'Instagram', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('contact_usGrid_instagram_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for publish_title field
            //
            $column = new TextViewColumn('publish_id', 'publish_id_publish_title', 'Publish', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('contact_usGrid_publish_id_publish_title_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for language field
            //
            $column = new TextViewColumn('language_id', 'language_id_language', 'Language', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('contact_usGrid_language_id_language_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for address field
            //
            $column = new TextViewColumn('address', 'address', 'Address', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('contact_usGrid_address_handler_export');
            $grid->AddExportColumn($column);
        }
    
        private function AddCompareColumns(Grid $grid)
        {
            //
            // View column for title field
            //
            $column = new TextViewColumn('title', 'title', 'Title', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('contact_usGrid_title_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for detail field
            //
            $column = new TextViewColumn('detail', 'detail', 'Detail', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('contact_usGrid_detail_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for video field
            //
            $column = new TextViewColumn('video', 'video', 'Video', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('contact_usGrid_video_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for working_hours field
            //
            $column = new TextViewColumn('working_hours', 'working_hours', 'Working Hours', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('contact_usGrid_working_hours_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for mobile1 field
            //
            $column = new TextViewColumn('mobile1', 'mobile1', 'Mobile1', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('contact_usGrid_mobile1_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for mobile2 field
            //
            $column = new TextViewColumn('mobile2', 'mobile2', 'Mobile2', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('contact_usGrid_mobile2_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for google_map field
            //
            $column = new TextViewColumn('google_map', 'google_map', 'Google Map', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('contact_usGrid_google_map_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for email field
            //
            $column = new TextViewColumn('email', 'email', 'Email', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('contact_usGrid_email_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for facebook field
            //
            $column = new TextViewColumn('facebook', 'facebook', 'Facebook', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('contact_usGrid_facebook_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for youtube field
            //
            $column = new TextViewColumn('youtube', 'youtube', 'Youtube', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('contact_usGrid_youtube_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for instagram field
            //
            $column = new TextViewColumn('instagram', 'instagram', 'Instagram', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('contact_usGrid_instagram_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for publish_title field
            //
            $column = new TextViewColumn('publish_id', 'publish_id_publish_title', 'Publish', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('contact_usGrid_publish_id_publish_title_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for language field
            //
            $column = new TextViewColumn('language_id', 'language_id_language', 'Language', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('contact_usGrid_language_id_language_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for address field
            //
            $column = new TextViewColumn('address', 'address', 'Address', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('contact_usGrid_address_handler_compare');
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
        
        public function GetEnableModalGridEdit() { return true; }
    
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
            $result->setMultiEditAllowed($this->GetSecurityInfo()->HasEditGrant() && true);
            $result->setIncludeAllFieldsForMultiEditByDefault(false);
            $result->setUseModalMultiEdit(true);
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
            // View column for title field
            //
            $column = new TextViewColumn('title', 'title', 'Title', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'contact_usGrid_title_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for mobile1 field
            //
            $column = new TextViewColumn('mobile1', 'mobile1', 'Mobile1', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'contact_usGrid_mobile1_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for mobile2 field
            //
            $column = new TextViewColumn('mobile2', 'mobile2', 'Mobile2', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'contact_usGrid_mobile2_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for email field
            //
            $column = new TextViewColumn('email', 'email', 'Email', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'contact_usGrid_email_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for publish_title field
            //
            $column = new TextViewColumn('publish_id', 'publish_id_publish_title', 'Publish', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'contact_usGrid_publish_id_publish_title_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for language field
            //
            $column = new TextViewColumn('language_id', 'language_id_language', 'Language', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'contact_usGrid_language_id_language_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for address field
            //
            $column = new TextViewColumn('address', 'address', 'Address', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'contact_usGrid_address_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for title field
            //
            $column = new TextViewColumn('title', 'title', 'Title', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'contact_usGrid_title_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for detail field
            //
            $column = new TextViewColumn('detail', 'detail', 'Detail', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'contact_usGrid_detail_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for video field
            //
            $column = new TextViewColumn('video', 'video', 'Video', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'contact_usGrid_video_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for working_hours field
            //
            $column = new TextViewColumn('working_hours', 'working_hours', 'Working Hours', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'contact_usGrid_working_hours_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for mobile1 field
            //
            $column = new TextViewColumn('mobile1', 'mobile1', 'Mobile1', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'contact_usGrid_mobile1_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for mobile2 field
            //
            $column = new TextViewColumn('mobile2', 'mobile2', 'Mobile2', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'contact_usGrid_mobile2_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for google_map field
            //
            $column = new TextViewColumn('google_map', 'google_map', 'Google Map', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'contact_usGrid_google_map_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for email field
            //
            $column = new TextViewColumn('email', 'email', 'Email', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'contact_usGrid_email_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for facebook field
            //
            $column = new TextViewColumn('facebook', 'facebook', 'Facebook', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'contact_usGrid_facebook_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for youtube field
            //
            $column = new TextViewColumn('youtube', 'youtube', 'Youtube', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'contact_usGrid_youtube_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for instagram field
            //
            $column = new TextViewColumn('instagram', 'instagram', 'Instagram', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'contact_usGrid_instagram_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for publish_title field
            //
            $column = new TextViewColumn('publish_id', 'publish_id_publish_title', 'Publish', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'contact_usGrid_publish_id_publish_title_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for language field
            //
            $column = new TextViewColumn('language_id', 'language_id_language', 'Language', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'contact_usGrid_language_id_language_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for address field
            //
            $column = new TextViewColumn('address', 'address', 'Address', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'contact_usGrid_address_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for title field
            //
            $column = new TextViewColumn('title', 'title', 'Title', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'contact_usGrid_title_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for detail field
            //
            $column = new TextViewColumn('detail', 'detail', 'Detail', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'contact_usGrid_detail_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for video field
            //
            $column = new TextViewColumn('video', 'video', 'Video', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'contact_usGrid_video_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for working_hours field
            //
            $column = new TextViewColumn('working_hours', 'working_hours', 'Working Hours', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'contact_usGrid_working_hours_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for mobile1 field
            //
            $column = new TextViewColumn('mobile1', 'mobile1', 'Mobile1', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'contact_usGrid_mobile1_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for mobile2 field
            //
            $column = new TextViewColumn('mobile2', 'mobile2', 'Mobile2', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'contact_usGrid_mobile2_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for google_map field
            //
            $column = new TextViewColumn('google_map', 'google_map', 'Google Map', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'contact_usGrid_google_map_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for email field
            //
            $column = new TextViewColumn('email', 'email', 'Email', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'contact_usGrid_email_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for facebook field
            //
            $column = new TextViewColumn('facebook', 'facebook', 'Facebook', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'contact_usGrid_facebook_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for youtube field
            //
            $column = new TextViewColumn('youtube', 'youtube', 'Youtube', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'contact_usGrid_youtube_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for instagram field
            //
            $column = new TextViewColumn('instagram', 'instagram', 'Instagram', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'contact_usGrid_instagram_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for publish_title field
            //
            $column = new TextViewColumn('publish_id', 'publish_id_publish_title', 'Publish', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'contact_usGrid_publish_id_publish_title_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for language field
            //
            $column = new TextViewColumn('language_id', 'language_id_language', 'Language', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'contact_usGrid_language_id_language_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for address field
            //
            $column = new TextViewColumn('address', 'address', 'Address', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'contact_usGrid_address_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`publish`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('publish_id', true, true, true),
                    new StringField('publish_title')
                )
            );
            $lookupDataset->setOrderByField('publish_title', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_contact_us_publish_id_search', 'publish_id', 'publish_title', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_contact_us_language_id_search', 'language_id', 'language', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for title field
            //
            $column = new TextViewColumn('title', 'title', 'Title', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'contact_usGrid_title_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for detail field
            //
            $column = new TextViewColumn('detail', 'detail', 'Detail', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'contact_usGrid_detail_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for video field
            //
            $column = new TextViewColumn('video', 'video', 'Video', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'contact_usGrid_video_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for working_hours field
            //
            $column = new TextViewColumn('working_hours', 'working_hours', 'Working Hours', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'contact_usGrid_working_hours_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for mobile1 field
            //
            $column = new TextViewColumn('mobile1', 'mobile1', 'Mobile1', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'contact_usGrid_mobile1_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for mobile2 field
            //
            $column = new TextViewColumn('mobile2', 'mobile2', 'Mobile2', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'contact_usGrid_mobile2_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for google_map field
            //
            $column = new TextViewColumn('google_map', 'google_map', 'Google Map', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'contact_usGrid_google_map_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for email field
            //
            $column = new TextViewColumn('email', 'email', 'Email', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'contact_usGrid_email_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for facebook field
            //
            $column = new TextViewColumn('facebook', 'facebook', 'Facebook', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'contact_usGrid_facebook_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for youtube field
            //
            $column = new TextViewColumn('youtube', 'youtube', 'Youtube', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'contact_usGrid_youtube_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for instagram field
            //
            $column = new TextViewColumn('instagram', 'instagram', 'Instagram', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'contact_usGrid_instagram_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for publish_title field
            //
            $column = new TextViewColumn('publish_id', 'publish_id_publish_title', 'Publish', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'contact_usGrid_publish_id_publish_title_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for language field
            //
            $column = new TextViewColumn('language_id', 'language_id_language', 'Language', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'contact_usGrid_language_id_language_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for address field
            //
            $column = new TextViewColumn('address', 'address', 'Address', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'contact_usGrid_address_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`publish`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('publish_id', true, true, true),
                    new StringField('publish_title')
                )
            );
            $lookupDataset->setOrderByField('publish_title', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_contact_us_publish_id_search', 'publish_id', 'publish_title', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_contact_us_language_id_search', 'language_id', 'language', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`publish`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('publish_id', true, true, true),
                    new StringField('publish_title')
                )
            );
            $lookupDataset->setOrderByField('publish_title', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_contact_us_publish_id_search', 'publish_id', 'publish_title', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_contact_us_language_id_search', 'language_id', 'language', null, 20);
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
        $Page = new contact_usPage("contact_us", "contact_us.php", GetCurrentUserPermissionSetForDataSource("contact_us"), 'UTF-8');
        $Page->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource("contact_us"));
        GetApplication()->SetMainPage($Page);
        GetApplication()->Run();
    }
    catch(Exception $e)
    {
        ShowErrorPage($e);
    }
	
