<?php namespace treehousetim\xcsrf;

class xcsrf
{
	// typically session key
	const StoreKey = 'xcsrf_code';
	// typically the value in GET or POST
	const RequestKey = 'xc';

	protected static $instance = null;
	protected $storedCode;	// string
	protected $requestCode;	// string

	protected $newCode;		// string

	protected $store; 		// storageInterface
	protected $request;		// requestInterface
	protected $protect;		// protectInterface

	protected function __construct( storageInterface $storage, requestInterface $request, protectInterface $protect = null )
	{
		$this->store = $storage;
		$this->request = $request;
		$this->protect = $protect;
		$this->init();
	}
	//------------------------------------------------------------------------
	public static function getInstance( storageInterface $storage = null, requestInterface $request = null, protectInterface $protect = null ) : xcsrf
	{
		if( static::$instance === null )
		{
			$storage = $storage ?? new sessionStorage();
			$request = $request ?? new httpRequest();
			$protect = $protect ?? new httpProtect();

			static::$instance = new static( $storage, $request, $protect );
		}

		return static::$instance;
	}
	//------------------------------------------------------------------------
	protected function init()
	{
		$this->enforceStorageEnabled();
		$this->loadStoredCode();
		$this->loadRequestCode();
		$this->getCode();
	}
	//------------------------------------------------------------------------
	public function compare() : bool
	{
		return $this->storedCode == $requestCode;
	}
	//------------------------------------------------------------------------
	public function loadStoredCode() : string
	{
		$this->storedCode = $this->store->getValue( self::StoreKey );
		return $this->storedCode;
	}
	//------------------------------------------------------------------------
	public function loadRequestCode() : string
	{
		$this->requestCode = $this->request->getValue( self::RequestKey );
		return $this->requestCode;
	}
	//------------------------------------------------------------------------
	public function requestMatchesStored() : bool
	{
		return $this->loadStoredCode() == $this->loadRequestCode();
	}
	//------------------------------------------------------------------------
	public function enforceStorageEnabled()
	{
		if( ! $this->store->enabled() )
		{
			throw $this->store->notEnabledException();
		}

		if( ! $this->store->active() )
		{
			throw $this->store->notActiveException();
		}
	}
	//------------------------------------------------------------------------
	public function getCode() : string
	{
		if( $this->newCode === null )
		{
			$this->newCode = bin2hex( random_bytes( 56 ) );
		}

		return $this->newCode;
	}
	//------------------------------------------------------------------------
	public function protect() : bool
	{
		if( $this->requestMatchesStored() == false )
		{
			$this->protect->halt();
			return false;
		}

		return true;
	}
}