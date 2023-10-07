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
    
    
    
    class news_activitiesPage extends Page
    {
        protected function DoBeforeCreate()
        {
            $this->SetTitle('News Activities');
            $this->SetMenuLabel('News Activities');
            $this->SetHeader(GetPagesHeader());
            $this->SetFooter(GetPagesFooter());
    
            $this->dataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`news_activities`');
            $this->dataset->addFields(
                array(
                    new IntegerField('news_id', true, true, true),
                    new StringField('title'),
                    new StringField('short_detail', true),
                    new StringField('detail'),
                    new StringField('photo1'),
                    new StringField('photo2'),
                    new StringField('photo3'),
                    new StringField('photo4'),
                    new StringField('video'),
                    new DateTimeField('publish_date'),
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
                new FilterColumn($this->dataset, 'news_id', 'news_id', 'News Id'),
                new FilterColumn($this->dataset, 'title', 'title', 'Title'),
                new FilterColumn($this->dataset, 'short_detail', 'short_detail', 'Short Detail'),
                new FilterColumn($this->dataset, 'detail', 'detail', 'Detail'),
                new FilterColumn($this->dataset, 'photo1', 'photo1', 'Photo1(800x400)'),
                new FilterColumn($this->dataset, 'photo2', 'photo2', 'Photo2(800x400)'),
                new FilterColumn($this->dataset, 'photo3', 'photo3', 'Photo3(800x400)'),
                new FilterColumn($this->dataset, 'photo4', 'photo4', 'Photo4(800x400)'),
                new FilterColumn($this->dataset, 'video', 'video', 'Video'),
                new FilterColumn($this->dataset, 'publish_date', 'publish_date', 'Publish Date'),
                new FilterColumn($this->dataset, 'publish_id', 'publish_id_publish_title', 'Publish'),
                new FilterColumn($this->dataset, 'language_id', 'language_id_language', 'Language')
            );
        }
    
        protected function setupQuickFilter(QuickFilter $quickFilter, FixedKeysArray $columns)
        {
            $quickFilter
                ->addColumn($columns['title'])
                ->addColumn($columns['short_detail'])
                ->addColumn($columns['detail'])
                ->addColumn($columns['photo1'])
                ->addColumn($columns['photo2'])
                ->addColumn($columns['photo3'])
                ->addColumn($columns['photo4'])
                ->addColumn($columns['video'])
                ->addColumn($columns['publish_date'])
                ->addColumn($columns['publish_id'])
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
            // View column for title field
            //
            $column = new TextViewColumn('title', 'title', 'Title', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('news_activitiesGrid_title_handler_list');
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
            $column->SetFullTextWindowHandlerName('news_activitiesGrid_short_detail_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for photo1 field
            //
            $column = new ExternalImageViewColumn('photo1', 'photo1', 'Photo1(800x400)', $this->dataset);
            $column->SetOrderable(true);
            $column->setSourcePrefixTemplate('../assets/img/activities/news/');
            $column->setWidth('150px');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for photo2 field
            //
            $column = new ExternalImageViewColumn('photo2', 'photo2', 'Photo2(800x400)', $this->dataset);
            $column->SetOrderable(true);
            $column->setSourcePrefixTemplate('../assets/img/activities/news/');
            $column->setWidth('150px');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for photo3 field
            //
            $column = new ExternalImageViewColumn('photo3', 'photo3', 'Photo3(800x400)', $this->dataset);
            $column->SetOrderable(true);
            $column->setSourcePrefixTemplate('../assets/img/activities/news/');
            $column->setWidth('150px');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for photo4 field
            //
            $column = new ExternalImageViewColumn('photo4', 'photo4', 'Photo4(800x400)', $this->dataset);
            $column->SetOrderable(true);
            $column->setSourcePrefixTemplate('../assets/img/activities/news/');
            $column->setWidth('150px');
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
            $column->SetFullTextWindowHandlerName('news_activitiesGrid_publish_id_publish_title_handler_list');
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
            $column->SetFullTextWindowHandlerName('news_activitiesGrid_language_id_language_handler_list');
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
            $column->SetFullTextWindowHandlerName('news_activitiesGrid_title_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for short_detail field
            //
            $column = new TextViewColumn('short_detail', 'short_detail', 'Short Detail', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('news_activitiesGrid_short_detail_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for detail field
            //
            $column = new TextViewColumn('detail', 'detail', 'Detail', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('news_activitiesGrid_detail_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for photo1 field
            //
            $column = new ExternalImageViewColumn('photo1', 'photo1', 'Photo1(800x400)', $this->dataset);
            $column->SetOrderable(true);
            $column->setSourcePrefixTemplate('../assets/img/activities/news/');
            $column->setWidth('150px');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for photo2 field
            //
            $column = new ExternalImageViewColumn('photo2', 'photo2', 'Photo2(800x400)', $this->dataset);
            $column->SetOrderable(true);
            $column->setSourcePrefixTemplate('../assets/img/activities/news/');
            $column->setWidth('150px');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for photo3 field
            //
            $column = new ExternalImageViewColumn('photo3', 'photo3', 'Photo3(800x400)', $this->dataset);
            $column->SetOrderable(true);
            $column->setSourcePrefixTemplate('../assets/img/activities/news/');
            $column->setWidth('150px');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for photo4 field
            //
            $column = new ExternalImageViewColumn('photo4', 'photo4', 'Photo4(800x400)', $this->dataset);
            $column->SetOrderable(true);
            $column->setSourcePrefixTemplate('../assets/img/activities/news/');
            $column->setWidth('150px');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for video field
            //
            $column = new TextViewColumn('video', 'video', 'Video', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('news_activitiesGrid_video_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for publish_date field
            //
            $column = new DateTimeViewColumn('publish_date', 'publish_date', 'Publish Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d H:i:s');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for publish_title field
            //
            $column = new TextViewColumn('publish_id', 'publish_id_publish_title', 'Publish', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('news_activitiesGrid_publish_id_publish_title_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for language field
            //
            $column = new TextViewColumn('language_id', 'language_id_language', 'Language', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('news_activitiesGrid_language_id_language_handler_view');
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
            // Edit column for photo1 field
            //
            $editor = new ImageUploader('photo1_edit');
            $editor->setInlineStyles('width:150px');
            $editor->SetShowImage(true);
            $editor->setAcceptableFileTypes('image/*');
            $editColumn = new UploadFileToFolderColumn('Photo1(800x400)', 'photo1', $editor, $this->dataset, false, false, '../assets/img/activities/news/', '%random%.%original_file_extension%', $this->OnFileUpload, true);
            $editColumn->SetReplaceUploadedFileIfExist(true);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for photo2 field
            //
            $editor = new ImageUploader('photo2_edit');
            $editor->setInlineStyles('width:150px');
            $editor->SetShowImage(true);
            $editor->setAcceptableFileTypes('image/*');
            $editColumn = new UploadFileToFolderColumn('Photo2(800x400)', 'photo2', $editor, $this->dataset, false, false, '../assets/img/activities/news/', '%random%.%original_file_extension%', $this->OnFileUpload, true);
            $editColumn->SetReplaceUploadedFileIfExist(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for photo3 field
            //
            $editor = new ImageUploader('photo3_edit');
            $editor->setInlineStyles('width:150px');
            $editor->SetShowImage(true);
            $editor->setAcceptableFileTypes('image/*');
            $editColumn = new UploadFileToFolderColumn('Photo3(800x400)', 'photo3', $editor, $this->dataset, false, false, '../assets/img/activities/news/', '%random%.%original_file_extension%', $this->OnFileUpload, true);
            $editColumn->SetReplaceUploadedFileIfExist(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for photo4 field
            //
            $editor = new ImageUploader('photo4_edit');
            $editor->setInlineStyles('width:150px');
            $editor->SetShowImage(true);
            $editor->setAcceptableFileTypes('image/*');
            $editColumn = new UploadFileToFolderColumn('Photo4(800x400)', 'photo4', $editor, $this->dataset, false, false, '../assets/img/activities/news/', '%random%.%original_file_extension%', $this->OnFileUpload, true);
            $editColumn->SetReplaceUploadedFileIfExist(true);
            $editColumn->SetAllowSetToNull(true);
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
            // Edit column for publish_date field
            //
            $editor = new DateTimeEdit('publish_date_edit', false, 'Y-m-d H:i:s');
            $editColumn = new CustomEditColumn('Publish Date', 'publish_date', $editor, $this->dataset);
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
            $editColumn = new DynamicLookupEditColumn('Publish', 'publish_id', 'publish_id_publish_title', 'edit_news_activities_publish_id_search', $editor, $this->dataset, $lookupDataset, 'publish_id', 'publish_title', '');
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
            $editColumn = new DynamicLookupEditColumn('Language', 'language_id', 'language_id_language', 'edit_news_activities_language_id_search', $editor, $this->dataset, $lookupDataset, 'language_id', 'language', '');
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
            // Edit column for photo1 field
            //
            $editor = new ImageUploader('photo1_edit');
            $editor->setInlineStyles('width:150px');
            $editor->SetShowImage(true);
            $editor->setAcceptableFileTypes('image/*');
            $editColumn = new UploadFileToFolderColumn('Photo1(800x400)', 'photo1', $editor, $this->dataset, false, false, '../assets/img/activities/news/', '%random%.%original_file_extension%', $this->OnFileUpload, true);
            $editColumn->SetReplaceUploadedFileIfExist(true);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for photo2 field
            //
            $editor = new ImageUploader('photo2_edit');
            $editor->setInlineStyles('width:150px');
            $editor->SetShowImage(true);
            $editor->setAcceptableFileTypes('image/*');
            $editColumn = new UploadFileToFolderColumn('Photo2(800x400)', 'photo2', $editor, $this->dataset, false, false, '../assets/img/activities/news/', '%random%.%original_file_extension%', $this->OnFileUpload, true);
            $editColumn->SetReplaceUploadedFileIfExist(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for photo3 field
            //
            $editor = new ImageUploader('photo3_edit');
            $editor->setInlineStyles('width:150px');
            $editor->SetShowImage(true);
            $editor->setAcceptableFileTypes('image/*');
            $editColumn = new UploadFileToFolderColumn('Photo3(800x400)', 'photo3', $editor, $this->dataset, false, false, '../assets/img/activities/news/', '%random%.%original_file_extension%', $this->OnFileUpload, true);
            $editColumn->SetReplaceUploadedFileIfExist(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for photo4 field
            //
            $editor = new ImageUploader('photo4_edit');
            $editor->setInlineStyles('width:150px');
            $editor->SetShowImage(true);
            $editor->setAcceptableFileTypes('image/*');
            $editColumn = new UploadFileToFolderColumn('Photo4(800x400)', 'photo4', $editor, $this->dataset, false, false, '../assets/img/activities/news/', '%random%.%original_file_extension%', $this->OnFileUpload, true);
            $editColumn->SetReplaceUploadedFileIfExist(true);
            $editColumn->SetAllowSetToNull(true);
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
            // Edit column for publish_date field
            //
            $editor = new DateTimeEdit('publish_date_edit', false, 'Y-m-d H:i:s');
            $editColumn = new CustomEditColumn('Publish Date', 'publish_date', $editor, $this->dataset);
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
            $editColumn = new DynamicLookupEditColumn('Publish', 'publish_id', 'publish_id_publish_title', 'multi_edit_news_activities_publish_id_search', $editor, $this->dataset, $lookupDataset, 'publish_id', 'publish_title', '');
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
            $editColumn = new DynamicLookupEditColumn('Language', 'language_id', 'language_id_language', 'multi_edit_news_activities_language_id_search', $editor, $this->dataset, $lookupDataset, 'language_id', 'language', '');
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
            // Edit column for photo1 field
            //
            $editor = new ImageUploader('photo1_edit');
            $editor->setInlineStyles('width:150px');
            $editor->SetShowImage(true);
            $editor->setAcceptableFileTypes('image/*');
            $editColumn = new UploadFileToFolderColumn('Photo1(800x400)', 'photo1', $editor, $this->dataset, false, false, '../assets/img/activities/news/', '%random%.%original_file_extension%', $this->OnFileUpload, true);
            $editColumn->SetReplaceUploadedFileIfExist(true);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for photo2 field
            //
            $editor = new ImageUploader('photo2_edit');
            $editor->setInlineStyles('width:150px');
            $editor->SetShowImage(true);
            $editor->setAcceptableFileTypes('image/*');
            $editColumn = new UploadFileToFolderColumn('Photo2(800x400)', 'photo2', $editor, $this->dataset, false, false, '../assets/img/activities/news/', '%random%.%original_file_extension%', $this->OnFileUpload, true);
            $editColumn->SetReplaceUploadedFileIfExist(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for photo3 field
            //
            $editor = new ImageUploader('photo3_edit');
            $editor->setInlineStyles('width:150px');
            $editor->SetShowImage(true);
            $editor->setAcceptableFileTypes('image/*');
            $editColumn = new UploadFileToFolderColumn('Photo3(800x400)', 'photo3', $editor, $this->dataset, false, false, '../assets/img/activities/news/', '%random%.%original_file_extension%', $this->OnFileUpload, true);
            $editColumn->SetReplaceUploadedFileIfExist(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for photo4 field
            //
            $editor = new ImageUploader('photo4_edit');
            $editor->setInlineStyles('width:150px');
            $editor->SetShowImage(true);
            $editor->setAcceptableFileTypes('image/*');
            $editColumn = new UploadFileToFolderColumn('Photo4(800x400)', 'photo4', $editor, $this->dataset, false, false, '../assets/img/activities/news/', '%random%.%original_file_extension%', $this->OnFileUpload, true);
            $editColumn->SetReplaceUploadedFileIfExist(true);
            $editColumn->SetAllowSetToNull(true);
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
            // Edit column for publish_date field
            //
            $editor = new DateTimeEdit('publish_date_edit', false, 'Y-m-d H:i:s');
            $editColumn = new CustomEditColumn('Publish Date', 'publish_date', $editor, $this->dataset);
            $editColumn->SetInsertDefaultValue('%CURRENT_DATETIME%');
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
            $editColumn = new DynamicLookupEditColumn('Publish', 'publish_id', 'publish_id_publish_title', 'insert_news_activities_publish_id_search', $editor, $this->dataset, $lookupDataset, 'publish_id', 'publish_title', '');
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
            $editColumn = new DynamicLookupEditColumn('Language', 'language_id', 'language_id_language', 'insert_news_activities_language_id_search', $editor, $this->dataset, $lookupDataset, 'language_id', 'language', '');
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
            // View column for title field
            //
            $column = new TextViewColumn('title', 'title', 'Title', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('news_activitiesGrid_title_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for short_detail field
            //
            $column = new TextViewColumn('short_detail', 'short_detail', 'Short Detail', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('news_activitiesGrid_short_detail_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for detail field
            //
            $column = new TextViewColumn('detail', 'detail', 'Detail', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('news_activitiesGrid_detail_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for photo1 field
            //
            $column = new ExternalImageViewColumn('photo1', 'photo1', 'Photo1(800x400)', $this->dataset);
            $column->SetOrderable(true);
            $column->setSourcePrefixTemplate('../assets/img/activities/news/');
            $column->setWidth('150px');
            $grid->AddPrintColumn($column);
            
            //
            // View column for photo2 field
            //
            $column = new ExternalImageViewColumn('photo2', 'photo2', 'Photo2(800x400)', $this->dataset);
            $column->SetOrderable(true);
            $column->setSourcePrefixTemplate('../assets/img/activities/news/');
            $column->setWidth('150px');
            $grid->AddPrintColumn($column);
            
            //
            // View column for photo3 field
            //
            $column = new ExternalImageViewColumn('photo3', 'photo3', 'Photo3(800x400)', $this->dataset);
            $column->SetOrderable(true);
            $column->setSourcePrefixTemplate('../assets/img/activities/news/');
            $column->setWidth('150px');
            $grid->AddPrintColumn($column);
            
            //
            // View column for photo4 field
            //
            $column = new ExternalImageViewColumn('photo4', 'photo4', 'Photo4(800x400)', $this->dataset);
            $column->SetOrderable(true);
            $column->setSourcePrefixTemplate('../assets/img/activities/news/');
            $column->setWidth('150px');
            $grid->AddPrintColumn($column);
            
            //
            // View column for video field
            //
            $column = new TextViewColumn('video', 'video', 'Video', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('news_activitiesGrid_video_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for publish_date field
            //
            $column = new DateTimeViewColumn('publish_date', 'publish_date', 'Publish Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d H:i:s');
            $grid->AddPrintColumn($column);
            
            //
            // View column for publish_title field
            //
            $column = new TextViewColumn('publish_id', 'publish_id_publish_title', 'Publish', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('news_activitiesGrid_publish_id_publish_title_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for language field
            //
            $column = new TextViewColumn('language_id', 'language_id_language', 'Language', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('news_activitiesGrid_language_id_language_handler_print');
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
            $column->SetFullTextWindowHandlerName('news_activitiesGrid_title_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for short_detail field
            //
            $column = new TextViewColumn('short_detail', 'short_detail', 'Short Detail', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('news_activitiesGrid_short_detail_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for detail field
            //
            $column = new TextViewColumn('detail', 'detail', 'Detail', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('news_activitiesGrid_detail_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for photo1 field
            //
            $column = new ExternalImageViewColumn('photo1', 'photo1', 'Photo1(800x400)', $this->dataset);
            $column->SetOrderable(true);
            $column->setSourcePrefixTemplate('../assets/img/activities/news/');
            $column->setWidth('150px');
            $grid->AddExportColumn($column);
            
            //
            // View column for photo2 field
            //
            $column = new ExternalImageViewColumn('photo2', 'photo2', 'Photo2(800x400)', $this->dataset);
            $column->SetOrderable(true);
            $column->setSourcePrefixTemplate('../assets/img/activities/news/');
            $column->setWidth('150px');
            $grid->AddExportColumn($column);
            
            //
            // View column for photo3 field
            //
            $column = new ExternalImageViewColumn('photo3', 'photo3', 'Photo3(800x400)', $this->dataset);
            $column->SetOrderable(true);
            $column->setSourcePrefixTemplate('../assets/img/activities/news/');
            $column->setWidth('150px');
            $grid->AddExportColumn($column);
            
            //
            // View column for photo4 field
            //
            $column = new ExternalImageViewColumn('photo4', 'photo4', 'Photo4(800x400)', $this->dataset);
            $column->SetOrderable(true);
            $column->setSourcePrefixTemplate('../assets/img/activities/news/');
            $column->setWidth('150px');
            $grid->AddExportColumn($column);
            
            //
            // View column for video field
            //
            $column = new TextViewColumn('video', 'video', 'Video', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('news_activitiesGrid_video_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for publish_date field
            //
            $column = new DateTimeViewColumn('publish_date', 'publish_date', 'Publish Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d H:i:s');
            $grid->AddExportColumn($column);
            
            //
            // View column for publish_title field
            //
            $column = new TextViewColumn('publish_id', 'publish_id_publish_title', 'Publish', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('news_activitiesGrid_publish_id_publish_title_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for language field
            //
            $column = new TextViewColumn('language_id', 'language_id_language', 'Language', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('news_activitiesGrid_language_id_language_handler_export');
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
            $column->SetFullTextWindowHandlerName('news_activitiesGrid_title_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for short_detail field
            //
            $column = new TextViewColumn('short_detail', 'short_detail', 'Short Detail', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('news_activitiesGrid_short_detail_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for detail field
            //
            $column = new TextViewColumn('detail', 'detail', 'Detail', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('news_activitiesGrid_detail_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for photo1 field
            //
            $column = new ExternalImageViewColumn('photo1', 'photo1', 'Photo1(800x400)', $this->dataset);
            $column->SetOrderable(true);
            $column->setSourcePrefixTemplate('../assets/img/activities/news/');
            $column->setWidth('150px');
            $grid->AddCompareColumn($column);
            
            //
            // View column for photo2 field
            //
            $column = new ExternalImageViewColumn('photo2', 'photo2', 'Photo2(800x400)', $this->dataset);
            $column->SetOrderable(true);
            $column->setSourcePrefixTemplate('../assets/img/activities/news/');
            $column->setWidth('150px');
            $grid->AddCompareColumn($column);
            
            //
            // View column for photo3 field
            //
            $column = new ExternalImageViewColumn('photo3', 'photo3', 'Photo3(800x400)', $this->dataset);
            $column->SetOrderable(true);
            $column->setSourcePrefixTemplate('../assets/img/activities/news/');
            $column->setWidth('150px');
            $grid->AddCompareColumn($column);
            
            //
            // View column for photo4 field
            //
            $column = new ExternalImageViewColumn('photo4', 'photo4', 'Photo4(800x400)', $this->dataset);
            $column->SetOrderable(true);
            $column->setSourcePrefixTemplate('../assets/img/activities/news/');
            $column->setWidth('150px');
            $grid->AddCompareColumn($column);
            
            //
            // View column for video field
            //
            $column = new TextViewColumn('video', 'video', 'Video', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('news_activitiesGrid_video_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for publish_date field
            //
            $column = new DateTimeViewColumn('publish_date', 'publish_date', 'Publish Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d H:i:s');
            $grid->AddCompareColumn($column);
            
            //
            // View column for publish_title field
            //
            $column = new TextViewColumn('publish_id', 'publish_id_publish_title', 'Publish', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('news_activitiesGrid_publish_id_publish_title_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for language field
            //
            $column = new TextViewColumn('language_id', 'language_id_language', 'Language', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('news_activitiesGrid_language_id_language_handler_compare');
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
            // View column for title field
            //
            $column = new TextViewColumn('title', 'title', 'Title', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'news_activitiesGrid_title_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for short_detail field
            //
            $column = new TextViewColumn('short_detail', 'short_detail', 'Short Detail', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'news_activitiesGrid_short_detail_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for publish_title field
            //
            $column = new TextViewColumn('publish_id', 'publish_id_publish_title', 'Publish', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'news_activitiesGrid_publish_id_publish_title_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for language field
            //
            $column = new TextViewColumn('language_id', 'language_id_language', 'Language', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'news_activitiesGrid_language_id_language_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for title field
            //
            $column = new TextViewColumn('title', 'title', 'Title', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'news_activitiesGrid_title_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for short_detail field
            //
            $column = new TextViewColumn('short_detail', 'short_detail', 'Short Detail', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'news_activitiesGrid_short_detail_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for detail field
            //
            $column = new TextViewColumn('detail', 'detail', 'Detail', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'news_activitiesGrid_detail_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for video field
            //
            $column = new TextViewColumn('video', 'video', 'Video', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'news_activitiesGrid_video_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for publish_title field
            //
            $column = new TextViewColumn('publish_id', 'publish_id_publish_title', 'Publish', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'news_activitiesGrid_publish_id_publish_title_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for language field
            //
            $column = new TextViewColumn('language_id', 'language_id_language', 'Language', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'news_activitiesGrid_language_id_language_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for title field
            //
            $column = new TextViewColumn('title', 'title', 'Title', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'news_activitiesGrid_title_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for short_detail field
            //
            $column = new TextViewColumn('short_detail', 'short_detail', 'Short Detail', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'news_activitiesGrid_short_detail_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for detail field
            //
            $column = new TextViewColumn('detail', 'detail', 'Detail', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'news_activitiesGrid_detail_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for video field
            //
            $column = new TextViewColumn('video', 'video', 'Video', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'news_activitiesGrid_video_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for publish_title field
            //
            $column = new TextViewColumn('publish_id', 'publish_id_publish_title', 'Publish', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'news_activitiesGrid_publish_id_publish_title_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for language field
            //
            $column = new TextViewColumn('language_id', 'language_id_language', 'Language', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'news_activitiesGrid_language_id_language_handler_compare', $column);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_news_activities_publish_id_search', 'publish_id', 'publish_title', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_news_activities_language_id_search', 'language_id', 'language', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for title field
            //
            $column = new TextViewColumn('title', 'title', 'Title', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'news_activitiesGrid_title_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for short_detail field
            //
            $column = new TextViewColumn('short_detail', 'short_detail', 'Short Detail', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'news_activitiesGrid_short_detail_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for detail field
            //
            $column = new TextViewColumn('detail', 'detail', 'Detail', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'news_activitiesGrid_detail_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for video field
            //
            $column = new TextViewColumn('video', 'video', 'Video', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'news_activitiesGrid_video_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for publish_title field
            //
            $column = new TextViewColumn('publish_id', 'publish_id_publish_title', 'Publish', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'news_activitiesGrid_publish_id_publish_title_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for language field
            //
            $column = new TextViewColumn('language_id', 'language_id_language', 'Language', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'news_activitiesGrid_language_id_language_handler_view', $column);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_news_activities_publish_id_search', 'publish_id', 'publish_title', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_news_activities_language_id_search', 'language_id', 'language', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_news_activities_publish_id_search', 'publish_id', 'publish_title', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_news_activities_language_id_search', 'language_id', 'language', null, 20);
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
        $Page = new news_activitiesPage("news_activities", "news_activities.php", GetCurrentUserPermissionSetForDataSource("news_activities"), 'UTF-8');
        $Page->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource("news_activities"));
        GetApplication()->SetMainPage($Page);
        GetApplication()->Run();
    }
    catch(Exception $e)
    {
        ShowErrorPage($e);
    }
	
