<?php
/**
 * @author Oliver Blum <blumanski@gmail.com>
 * @date 2016-01-02
 *
 * Ajax controller
 * Does not implement the interface
 * Does not need templates
 * 
 */

Namespace Bang\Modules\Content;

Use Bang\Modules\Content\Models\Db,
	Bang\Modules\Content\Models\Mail,
	Bang\Modules\Content\Models\Scenes,
	Bang\Tools\Awss3,
    Bang\Helper;

class ajaxController extends \Bang\SuperController
{
	/**
	 * Modules DB Model
	 * @var object
	 */
	private $Data;
	
	/**
	 * View object
	 * @var object
	 */
	private $View;
	
	/**
	 * ErrorLog object
	 * @var object
	 */
	private $ErrorLog;
	
	/**
	 * Instance of Language object
	 * @var object
	 */
	private $Lang;
	
	/**
	 * Instance of Mail object
	 * @var object
	 */
	private $Mail;
	
	
	private $S3;
	
	/*
	 * Set up the class environment
	 * @param object $di
	 */
    public function __construct(\stdClass $di)
    {
        $this->path     		= dirname(dirname(__FILE__));
    	// assign class variables
    	$this->ErrorLog 		= $di->ErrorLog;
    	$this->View				= $di->View;
    	$this->Session          = $di->Session;
    	$this->Lang				= $di->View->Lang;
    	
    	// Get the current language loaded
    	$currentLang = $this->View->Lang->LangLoaded;
    	
    	$this->Overwrite = $this->getBackTplOverwrite();

    	// Add module language files to language array
    	$this->View->Lang->addLanguageFile($this->path.'/lang/'.$currentLang);

    	// every action function in this class needs a permission check
    	// in this case, I can add it to the constructor
    	$this->testPermisions();
    	
    	$this->Data		= new Db($di);
    	$this->Scenes 	= new Scenes($di);
    	$this->Mail		= new Mail($di);
    	$this->Data->setMailInstance($this->Mail);
    	
    	// AWS instance
    	$this->S3 = new \Bang\Tools\Awss3();
    }
    
    /**
     * Permission test
     * 1. Test if user is logged in
     */
    private function testPermisions()
    {
    	// 1. if user is not logegd in, redirect to login with message
    	if($this->Session->loggedIn() === false || $this->Session->hasPermission(1) !== true) {
    		$this->Session->setError($this->Lang->get('application_notlogged_in'));
    		Helper::redirectTo('/account/index/login/');
    		exit;
    	}
    }
    
    /**
     * Get a list of authors from google books
     * @return boolean
     */
    public function findAuthorAction()
    {
    	$post  = Helper::getRequestParams('post');
    	$post  = Helper::prepareAjaxValues($post);
    	
    	if(is_array($post) && isset($post['phrase']) && !empty($post['phrase'])) {
    		//$result = $this->Books->searchGoogleBooks('inauthor:Smith&maxResults=40&orderBy=relevance');
    		
    		$result = $this->Scenes->findAuthor($post['phrase']);
    		
    		if(is_array($result) && count($result)) {
    			
    			die(json_encode($result));
    		}
    	}
    	
    	die(json_encode(array('outcome' => 'failed', 'messages' => 'No data found.')));
    }
    
    /**
     * Must be in all classes
     * @return array
     */
    public function __debugInfo() {
    
    	$reflect	= new \ReflectionObject($this);
    	$varArray	= array();
    
    	foreach ($reflect->getProperties(\ReflectionProperty::IS_PUBLIC) as $prop) {
    		$propName = $prop->getName();
    		 
    		if($propName !== 'DI') {
    			//print '--> '.$propName.'<br />';
    			$varArray[$propName] = $this->$propName;
    		}
    	}
    
    	return $varArray;
    }
}
