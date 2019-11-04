<?php

  namespace Xibo\Custom\Udp2Ws;
 
//use Xibo\Widget;
use \Xibo\Exception\InvalidArgumentException;
use \Xibo\Factory\DisplayGroupFactory;
 

 
 
class Udp2Ws   extends \Xibo\Widget\ModuleWidget
{
     

    /**
     * Install or Update this module
     * @param ModuleFactory $moduleFactory
     */
    public function installOrUpdate($moduleFactory)
    {
        if ($this->module == null) {
            // Install
            $module = $moduleFactory->createEmpty();
            $module->name = 'udp2ws';
            $module->type = 'udp2ws';
            $module->class = 'Xibo\Custom\udp2ws\Udp2Ws'; 
            $module->description = 'A module for manipulating the html blocks based on signals received by websocket connection.';
            $module->enabled = 1;
            $module->previewEnabled = 1;
            $module->assignable = 1;
            $module->regionSpecific = 1;
            $module->renderAs = 'html';
            $module->schemaVersion = $this->codeSchemaVersion;
            $module->defaultDuration = 86400;
            $module->settings = [];
            $module->viewPath = '../custom/udp2ws';

            $this->setModule($module);
            $this->installModule();
        }

        // Check we are all installed
        $this->installFiles();
    }

    /**
     * Install Files
     */
    public function installFiles()
    {
        $this->mediaFactory->createModuleSystemFile(PROJECT_ROOT . '/modules/vendor/jquery-1.11.1.min.js')->save();
 
    }


    /**
     * Javascript functions for the layout designer
     */
    public function layoutDesignerJavaScript()
    {
        return 'udp2ws-designer-javascript';
    }

    /**
     * Form for updating the module settings
     */
    public function settingsForm()
    {
        return 'udp2ws-form-settings';
    }

    /**
     * Process any module settings
     * @throws InvalidArgumentException
     */
    public function settings()
    {
		
		var_dump('SETTINGS 444444444'); EXIT;
        $apiKey = $this->getSanitizer()->getString('apiKey');
        $cachePeriod = $this->getSanitizer()->getInt('cachePeriod', 14400);
		
		
		        $this->module->settings['apiKey'] = $apiKey;
        $this->module->settings['cachePeriod'] = $cachePeriod;

        // Return an array of the processed settings.
        return $this->module->settings;
		

        if ($this->module->enabled != 0) {
            if ($apiKey == '')
                throw new InvalidArgumentException(__('Missing API Key'), 'apiKey');

            if ($cachePeriod < 3600)
                throw new InvalidArgumentException(__('Cache Period must be 3600 or greater for this Module'), 'cachePeriod');
        }

        $this->module->settings['apiKey'] = $apiKey;
        $this->module->settings['cachePeriod'] = $cachePeriod;

        // Return an array of the processed settings.
        return $this->module->settings;
    }

    /**
     * Edit Widget

     *
     * @throws \Xibo\Exception\XiboException
     */
    public function edit()
    {


        //var_dump($this->DisplayGroupFactory , $this->DisplayFactory, $this->getStore()->select('select * from displaygroup', []) );

       // var_dump(3333333); exit;
        $this->setDuration($this->getSanitizer()->getInt('duration', $this->getDuration()));
        $this->setUseDuration($this->getSanitizer()->getCheckbox('useDuration'));




        $this->setOption('name', $this->getSanitizer()->getString('name'));
		$this->setOption('backgroundColor', $this->getSanitizer()->getString('backgroundColor'));


		$this->setOption('redColor', $this->getSanitizer()->getString('redColor'));
		$this->setOption('greenColor', $this->getSanitizer()->getString('greenColor'));
		$this->setOption('blinkColor', $this->getSanitizer()->getString('blinkColor'));
		$this->setOption('textColor', $this->getSanitizer()->getString('textColor'));
		$this->setOption('blinktextColor', $this->getSanitizer()->getString('blinktextColor'));
		$this->setOption('blinkTime', $this->getSanitizer()->getString('blinkTime'));


        $this->setRawNode('mainTemplate',  $this->getSanitizer()->getParam('mainTemplate', $this->getSanitizer()->getParam('mainTemplate', null)) );
        $this->setRawNode('cssCode',  $this->getSanitizer()->getParam('cssCode', $this->getSanitizer()->getParam('cssCode', null)) );
        $this->setRawNode('jsCode',  $this->getSanitizer()->getParam('jsCode', $this->getSanitizer()->getParam('jsCode', null)) );


        $this->setOption('blockCaption', $this->getSanitizer()->getString('blockCaption'));
        $this->setOption('serverUrl', trim($this->getSanitizer()->getString('serverUrl') ) );
        $this->setOption('blockHeight', $this->getSanitizer()->getString('blockHeight'));
        $this->setOption('blockWidth', $this->getSanitizer()->getString('blockWidth'));
        $this->setOption('totalHeight', $this->getSanitizer()->getString('totalHeight'));
        $this->setOption('totalWidth', $this->getSanitizer()->getString('totalWidth'));
        $this->setOption('borderWidth', $this->getSanitizer()->getString('borderWidth'));
        $this->setOption('borderHeight', $this->getSanitizer()->getString('borderHeight'));
        $this->setOption('fontSize', $this->getSanitizer()->getString('fontSize'));
        $this->setOption('borderBackgroundColor', $this->getSanitizer()->getString('borderBackgroundColor'));



		    // Save the widget
        $this->isValid();
        $this->saveWidget();

/*        var_dump(144441111,

            $this->getOption('backgroundColor', 5)
        );

        EXIT;*/


    }


    /** @inheritdoc */
    public function getResource($displayId = 0)
    {

//error_reporting(E_ALL);
//ini_set('display_errors', true);



        $configs = [];

#configs
        $configs['blockCaption']  = $this->getRawNode('blockCaption', 'Kasse' );
        $configs['serverUrl']  =   $this->getRawNode('serverUrl', 'wss://localhost:8081' )  ;

        $displayId = 5;
        $dArray = [];
        if($displayId && $dArray = $this->getStore()->select('select * from lkdisplaydg where DisplayID = ? ', [$displayId]) ) {

            $dIds = [];
            foreach($dArray as $arr) {
                $dIds[] =  $arr['DisplayGroupID'];
            }

            $configs['serverUrl'] = $configs['serverUrl'] . '&?groups=' . implode(',', $dIds );
           // $this->getStore()->select('select * from lkdisplaydg where DisplayID = ? ', [$displayId]);
        }


      //  var_dump($this->DisplayGroupFactory , $this->DisplayFactory, $this->getStore()->select('select * from displaygroup', []) );

      //  $configs['serverUrl'

#sizes
        $configs['blockHeight']  = $this->getRawNode('blockHeight', '100%' );
        $configs['blockWidth']  = $this->getRawNode('blockWidth', '24.75%' );
        $configs['totalHeight']  = $this->getRawNode('totalHeight', '100%' );
        $configs['totalWidth']  = $this->getRawNode('totalWidth', '100%' );
        $configs['borderWidth']  = $this->getRawNode('totalWidth', '0.25%' );
        $configs['borderHeight']  = $this->getRawNode('borderHeight', '100%' );

#colors
        $configs['textColor']  = $this->getRawNode('textColor', 'white' );
        $configs['fontSize']  = $this->getRawNode('fontSize', '4rem' );
        $configs['backgroundColor']  = $this->getRawNode('backgroundColor', 'red' );
        $configs['borderBackgroundColor']  = $this->getRawNode('borderBackgroundColor', 'white' );
        $configs['redColor']  = $this->getRawNode('redColor', 'red' );
        $configs['greenColor']  = $this->getRawNode('greenColor', 'green' );
        $configs['blinkColor']  = $this->getRawNode('greenColor', 'white' );
        $configs['blinktextColor']  = $this->getRawNode('greenColor', 'black' );
        $configs['blinkTime']  = $this->getRawNode('blinkTime', '1s' );


        $configs['displayId']  = $displayId;


        $search =  array_map( function($var) { return '{' . $var . '}';  }
                                , array_keys($configs)

                     );

        $cssCode = str_replace($search,  $configs , $this->getRawNode('cssCode', null) );
        $jsCode = str_replace($search,  $configs , $this->getRawNode('jsCode', null) );
        $body = str_replace($search,  $configs , $this->getRawNode('mainTemplate', null)      );




	 $this
        ->initialiseGetResource()
        ->appendViewPortWidth($this->region->width)
        ->appendJavaScriptFile('vendor/jquery-1.11.1.min.js')
        ->appendFontCss() 
        ->appendBody( $body )
        ->appendRaw('javaScript',  $jsCode  )
        ->appendCss( $cssCode  );
       // ->appendJavaScript('$(document).ready(function() { $("h1").html("My Altered HTML"); } ');
        
    return $this->finaliseGetResource();
	

 

    }

    /** @inheritdoc */
    public function isValid()
    {
		
		return self::$STATUS_VALID;
		 throw new InvalidArgumentException(__('Please choose a template'), 'templateId');
		return 1;
		
        if ($this->getOption('overrideTemplate') == 0 && ( $this->getOption('templateId') == '' || $this->getOption('templateId') == null))
            throw new InvalidArgumentException(__('Please choose a template'), 'templateId');

        if ($this->getUseDuration() == 1 && $this->getDuration() == 0)
            throw new InvalidArgumentException(__('Please enter a duration'), 'duration');

        // Validate for the items field
        if ($this->getOption('items') == '')
            throw new InvalidArgumentException(__('Please provide a comma separated list of symbols in the items field.'), 'items');

        return self::$STATUS_VALID;
    }

    /** @inheritdoc */
    public function getCacheDuration()
    {
		
		
		return 86400;
		
		
        $cachePeriod = $this->getSetting('cachePeriod', 86400);
        $updateInterval = $this->getSetting('updateInterval', 3600);

        return max($cachePeriod, $updateInterval);
    }
}
