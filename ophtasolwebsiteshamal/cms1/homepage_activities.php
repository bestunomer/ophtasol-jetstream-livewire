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
    
    
    
    class homepage_activitiesPage extends Page
    {
        protected function DoBeforeCreate()
        {
            $this->SetTitle('Homepage Activities');
            $this->SetMenuLabel('Homepage Activities');
            $this->SetHeader(GetPagesHeader());
            $this->SetFooter(GetPagesFooter());
    
            $this->dataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`homepage_activities`');
            $this->dataset->addFields(
                array(
                    new IntegerField('activities_id', true, true, true),
                    new StringField('title', true),
                    new StringField('short_detail', true),
                    new StringField('detail', true),
                    new StringField('activities_icon', true),
                    new StringField('photo', true),
                    new StringField('video_link', true),
                    new IntegerField('publish_id', true),
                    new IntegerField('language_id', true)
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
                new FilterColumn($this->dataset, 'activities_id', 'activities_id', 'Activities Id'),
                new FilterColumn($this->dataset, 'title', 'title', 'Title'),
                new FilterColumn($this->dataset, 'short_detail', 'short_detail', 'Short Detail'),
                new FilterColumn($this->dataset, 'detail', 'detail', 'Detail'),
                new FilterColumn($this->dataset, 'activities_icon', 'activities_icon', 'Activities Icon'),
                new FilterColumn($this->dataset, 'photo', 'photo', 'Photo(900x500)'),
                new FilterColumn($this->dataset, 'video_link', 'video_link', 'Video Link'),
                new FilterColumn($this->dataset, 'publish_id', 'publish_id_publish_title', 'Publish'),
                new FilterColumn($this->dataset, 'language_id', 'language_id_language', 'Language')
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
            // View column for title field
            //
            $column = new TextViewColumn('title', 'title', 'Title', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('homepage_activitiesGrid_title_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for short_detail field
            //
            $column = new TextViewColumn('short_detail', 'short_detail', 'Short Detail', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('homepage_activitiesGrid_short_detail_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for photo field
            //
            $column = new ExternalImageViewColumn('photo', 'photo', 'Photo(900x500)', $this->dataset);
            $column->SetOrderable(true);
            $column->setSourcePrefixTemplate('../assets/img/activities/homepage/');
            $column->setWidth('150px');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for video_link field
            //
            $column = new TextViewColumn('video_link', 'video_link', 'Video Link', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('homepage_activitiesGrid_video_link_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for publish_title field
            //
            $column = new TextViewColumn('publish_id', 'publish_id_publish_title', 'Publish', $this->dataset);
            $column->SetOrderable(true);
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
            // View column for title field
            //
            $column = new TextViewColumn('title', 'title', 'Title', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('homepage_activitiesGrid_title_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for short_detail field
            //
            $column = new TextViewColumn('short_detail', 'short_detail', 'Short Detail', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('homepage_activitiesGrid_short_detail_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for detail field
            //
            $column = new TextViewColumn('detail', 'detail', 'Detail', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('homepage_activitiesGrid_detail_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for activities_icon field
            //
            $column = new TextViewColumn('activities_icon', 'activities_icon', 'Activities Icon', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('homepage_activitiesGrid_activities_icon_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for photo field
            //
            $column = new ExternalImageViewColumn('photo', 'photo', 'Photo(900x500)', $this->dataset);
            $column->SetOrderable(true);
            $column->setSourcePrefixTemplate('../assets/img/activities/homepage/');
            $column->setWidth('150px');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for video_link field
            //
            $column = new TextViewColumn('video_link', 'video_link', 'Video Link', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('homepage_activitiesGrid_video_link_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for publish_title field
            //
            $column = new TextViewColumn('publish_id', 'publish_id_publish_title', 'Publish', $this->dataset);
            $column->SetOrderable(true);
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
            // Edit column for short_detail field
            //
            $editor = new TextEdit('short_detail_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Short Detail', 'short_detail', $editor, $this->dataset);
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
            // Edit column for activities_icon field
            //
            $editor = new TextEdit('activities_icon_edit');
            $editor->SetMaxLength(150);
            $editColumn = new CustomEditColumn('Activities Icon', 'activities_icon', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for photo field
            //
            $editor = new ImageUploader('photo_edit');
            $editor->setInlineStyles('width:150px');
            $editor->SetShowImage(false);
            $editColumn = new UploadFileToFolderColumn('Photo(900x500)', 'photo', $editor, $this->dataset, false, false, '../assets/img/activities/homepage/', '%random%.%original_file_extension%', $this->OnFileUpload, true);
            $editColumn->SetReplaceUploadedFileIfExist(true);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for video_link field
            //
            $editor = new TextEdit('video_link_edit');
            $editor->SetMaxLength(200);
            $editColumn = new CustomEditColumn('Video Link', 'video_link', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
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
            $editColumn = new DynamicLookupEditColumn('Publish', 'publish_id', 'publish_id_publish_title', 'edit_homepage_activities_publish_id_search', $editor, $this->dataset, $lookupDataset, 'publish_id', 'publish_title', '');
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
            $editColumn = new DynamicLookupEditColumn('Language', 'language_id', 'language_id_language', 'edit_homepage_activities_language_id_search', $editor, $this->dataset, $lookupDataset, 'language_id', 'language', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
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
            // Edit column for short_detail field
            //
            $editor = new TextEdit('short_detail_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Short Detail', 'short_detail', $editor, $this->dataset);
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
            // Edit column for activities_icon field
            //
            $editor = new TextEdit('activities_icon_edit');
            $editor->SetMaxLength(150);
            $editColumn = new CustomEditColumn('Activities Icon', 'activities_icon', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for photo field
            //
            $editor = new ImageUploader('photo_edit');
            $editor->setInlineStyles('width:150px');
            $editor->SetShowImage(false);
            $editColumn = new UploadFileToFolderColumn('Photo(900x500)', 'photo', $editor, $this->dataset, false, false, '../assets/img/activities/homepage/', '%random%.%original_file_extension%', $this->OnFileUpload, true);
            $editColumn->SetReplaceUploadedFileIfExist(true);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for video_link field
            //
            $editor = new TextEdit('video_link_edit');
            $editor->SetMaxLength(200);
            $editColumn = new CustomEditColumn('Video Link', 'video_link', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
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
            $editColumn = new DynamicLookupEditColumn('Publish', 'publish_id', 'publish_id_publish_title', 'multi_edit_homepage_activities_publish_id_search', $editor, $this->dataset, $lookupDataset, 'publish_id', 'publish_title', '');
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
            $editColumn = new DynamicLookupEditColumn('Language', 'language_id', 'language_id_language', 'multi_edit_homepage_activities_language_id_search', $editor, $this->dataset, $lookupDataset, 'language_id', 'language', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
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
            // Edit column for short_detail field
            //
            $editor = new TextEdit('short_detail_edit');
            $editor->SetMaxLength(250);
            $editColumn = new CustomEditColumn('Short Detail', 'short_detail', $editor, $this->dataset);
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
            // Edit column for activities_icon field
            //
            $editor = new TextEdit('activities_icon_edit');
            $editor->SetMaxLength(150);
            $editColumn = new CustomEditColumn('Activities Icon', 'activities_icon', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for photo field
            //
            $editor = new ImageUploader('photo_edit');
            $editor->setInlineStyles('width:150px');
            $editor->SetShowImage(false);
            $editColumn = new UploadFileToFolderColumn('Photo(900x500)', 'photo', $editor, $this->dataset, false, false, '../assets/img/activities/homepage/', '%random%.%original_file_extension%', $this->OnFileUpload, true);
            $editColumn->SetReplaceUploadedFileIfExist(true);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for video_link field
            //
            $editor = new TextEdit('video_link_edit');
            $editor->SetMaxLength(200);
            $editColumn = new CustomEditColumn('Video Link', 'video_link', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
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
            $editColumn = new DynamicLookupEditColumn('Publish', 'publish_id', 'publish_id_publish_title', 'insert_homepage_activities_publish_id_search', $editor, $this->dataset, $lookupDataset, 'publish_id', 'publish_title', '');
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
            $editColumn = new DynamicLookupEditColumn('Language', 'language_id', 'language_id_language', 'insert_homepage_activities_language_id_search', $editor, $this->dataset, $lookupDataset, 'language_id', 'language', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
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
            $column->SetFullTextWindowHandlerName('homepage_activitiesGrid_title_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for short_detail field
            //
            $column = new TextViewColumn('short_detail', 'short_detail', 'Short Detail', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('homepage_activitiesGrid_short_detail_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for detail field
            //
            $column = new TextViewColumn('detail', 'detail', 'Detail', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('homepage_activitiesGrid_detail_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for activities_icon field
            //
            $column = new TextViewColumn('activities_icon', 'activities_icon', 'Activities Icon', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('homepage_activitiesGrid_activities_icon_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for photo field
            //
            $column = new ExternalImageViewColumn('photo', 'photo', 'Photo(900x500)', $this->dataset);
            $column->SetOrderable(true);
            $column->setSourcePrefixTemplate('../assets/img/activities/homepage/');
            $column->setWidth('150px');
            $grid->AddPrintColumn($column);
            
            //
            // View column for video_link field
            //
            $column = new TextViewColumn('video_link', 'video_link', 'Video Link', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('homepage_activitiesGrid_video_link_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for publish_title field
            //
            $column = new TextViewColumn('publish_id', 'publish_id_publish_title', 'Publish', $this->dataset);
            $column->SetOrderable(true);
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
            // View column for title field
            //
            $column = new TextViewColumn('title', 'title', 'Title', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('homepage_activitiesGrid_title_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for short_detail field
            //
            $column = new TextViewColumn('short_detail', 'short_detail', 'Short Detail', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('homepage_activitiesGrid_short_detail_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for detail field
            //
            $column = new TextViewColumn('detail', 'detail', 'Detail', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('homepage_activitiesGrid_detail_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for activities_icon field
            //
            $column = new TextViewColumn('activities_icon', 'activities_icon', 'Activities Icon', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('homepage_activitiesGrid_activities_icon_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for photo field
            //
            $column = new ExternalImageViewColumn('photo', 'photo', 'Photo(900x500)', $this->dataset);
            $column->SetOrderable(true);
            $column->setSourcePrefixTemplate('../assets/img/activities/homepage/');
            $column->setWidth('150px');
            $grid->AddExportColumn($column);
            
            //
            // View column for video_link field
            //
            $column = new TextViewColumn('video_link', 'video_link', 'Video Link', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('homepage_activitiesGrid_video_link_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for publish_title field
            //
            $column = new TextViewColumn('publish_id', 'publish_id_publish_title', 'Publish', $this->dataset);
            $column->SetOrderable(true);
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
            // View column for title field
            //
            $column = new TextViewColumn('title', 'title', 'Title', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('homepage_activitiesGrid_title_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for short_detail field
            //
            $column = new TextViewColumn('short_detail', 'short_detail', 'Short Detail', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('homepage_activitiesGrid_short_detail_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for detail field
            //
            $column = new TextViewColumn('detail', 'detail', 'Detail', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('homepage_activitiesGrid_detail_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for activities_icon field
            //
            $column = new TextViewColumn('activities_icon', 'activities_icon', 'Activities Icon', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('homepage_activitiesGrid_activities_icon_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for photo field
            //
            $column = new ExternalImageViewColumn('photo', 'photo', 'Photo(900x500)', $this->dataset);
            $column->SetOrderable(true);
            $column->setSourcePrefixTemplate('../assets/img/activities/homepage/');
            $column->setWidth('150px');
            $grid->AddCompareColumn($column);
            
            //
            // View column for video_link field
            //
            $column = new TextViewColumn('video_link', 'video_link', 'Video Link', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('homepage_activitiesGrid_video_link_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for publish_title field
            //
            $column = new TextViewColumn('publish_id', 'publish_id_publish_title', 'Publish', $this->dataset);
            $column->SetOrderable(true);
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
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'homepage_activitiesGrid_title_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for short_detail field
            //
            $column = new TextViewColumn('short_detail', 'short_detail', 'Short Detail', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'homepage_activitiesGrid_short_detail_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for video_link field
            //
            $column = new TextViewColumn('video_link', 'video_link', 'Video Link', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'homepage_activitiesGrid_video_link_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for title field
            //
            $column = new TextViewColumn('title', 'title', 'Title', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'homepage_activitiesGrid_title_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for short_detail field
            //
            $column = new TextViewColumn('short_detail', 'short_detail', 'Short Detail', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'homepage_activitiesGrid_short_detail_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for detail field
            //
            $column = new TextViewColumn('detail', 'detail', 'Detail', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'homepage_activitiesGrid_detail_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for activities_icon field
            //
            $column = new TextViewColumn('activities_icon', 'activities_icon', 'Activities Icon', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'homepage_activitiesGrid_activities_icon_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for video_link field
            //
            $column = new TextViewColumn('video_link', 'video_link', 'Video Link', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'homepage_activitiesGrid_video_link_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for title field
            //
            $column = new TextViewColumn('title', 'title', 'Title', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'homepage_activitiesGrid_title_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for short_detail field
            //
            $column = new TextViewColumn('short_detail', 'short_detail', 'Short Detail', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'homepage_activitiesGrid_short_detail_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for detail field
            //
            $column = new TextViewColumn('detail', 'detail', 'Detail', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'homepage_activitiesGrid_detail_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for activities_icon field
            //
            $column = new TextViewColumn('activities_icon', 'activities_icon', 'Activities Icon', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'homepage_activitiesGrid_activities_icon_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for video_link field
            //
            $column = new TextViewColumn('video_link', 'video_link', 'Video Link', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'homepage_activitiesGrid_video_link_handler_compare', $column);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_homepage_activities_publish_id_search', 'publish_id', 'publish_title', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_homepage_activities_language_id_search', 'language_id', 'language', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for title field
            //
            $column = new TextViewColumn('title', 'title', 'Title', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'homepage_activitiesGrid_title_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for short_detail field
            //
            $column = new TextViewColumn('short_detail', 'short_detail', 'Short Detail', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'homepage_activitiesGrid_short_detail_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for detail field
            //
            $column = new TextViewColumn('detail', 'detail', 'Detail', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'homepage_activitiesGrid_detail_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for activities_icon field
            //
            $column = new TextViewColumn('activities_icon', 'activities_icon', 'Activities Icon', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'homepage_activitiesGrid_activities_icon_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for video_link field
            //
            $column = new TextViewColumn('video_link', 'video_link', 'Video Link', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'homepage_activitiesGrid_video_link_handler_view', $column);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_homepage_activities_publish_id_search', 'publish_id', 'publish_title', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_homepage_activities_language_id_search', 'language_id', 'language', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_homepage_activities_publish_id_search', 'publish_id', 'publish_title', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_homepage_activities_language_id_search', 'language_id', 'language', null, 20);
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
        $Page = new homepage_activitiesPage("homepage_activities", "homepage_activities.php", GetCurrentUserPermissionSetForDataSource("homepage_activities"), 'UTF-8');
        $Page->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource("homepage_activities"));
        GetApplication()->SetMainPage($Page);
        GetApplication()->Run();
    }
    catch(Exception $e)
    {
        ShowErrorPage($e);
    }
	
