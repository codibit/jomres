<?php
/**
 * Core file
 * @author Vince Wooll <sales@jomres.net>
 * @version Jomres 4
* @package Jomres
* @copyright	2005-2009 Vince Wooll

Jomres is distributed as a mix of two licenses (excepting other files in the libraries folder, which are independantly licensed). 

The first, proprietary license, refers to Jomres as a package. You cannot share it, period. You can see the full license here http://www.jomres.net/license.html. There are some exceptions, and these files are independantly licensed (see the /jomres/libraries/phptools folder for example)
The files in the /jomres/core-minicomponents,  /jomres/libraries/jomres/cms_specific and the /jomres/templates folders, whilst copyright Vince Wooll, are licensed differently to allow those users who wish, to develop and distribute their own third party plugins for Jomres. Those files are licensed under the MIT license, which allows third party vendors to modify them to suit their own requirements and if so desired, distribute them for free or cost. 

################################################################
This file is subject to the Jomres proprietary license, please do not distribute it. For licencing information, please visit 
http://www.jomres.net/index.php?option=com_content&task=view&id=214&Itemid=86 and http://www.jomres.net/license.html
################################################################
*/

// ################################################################
defined( '_JOMRES_INITCHECK' ) or die( 'Direct Access to this file is not allowed.' );
// ################################################################
	
class jrportal_property
	{
	function jrportal_property()
		{
		$this->id					= 0;
		$this->property_id			= 0;
		$this->crate_id				= 0;
		//$this->property_name		= '';
		$this->property_address		= '';
		$this->property_managers	= array();

		$this->propertys_uid		= 0;
		$this->property_name		= '';
		$this->property_street		= '';
		$this->property_town		= '';
		$this->property_region		= '';
		$this->property_country		= '';
		$this->property_postcode	= '';
		$this->property_tel			= '';
		$this->property_fax			= '';
		$this->property_email		= '';
		$this->property_features	= '';
		$this->property_mappinglink	= '';
		$this->property_description	= '';
		$this->property_checkin_times			= '';
		$this->property_area_activities			= '';
		$this->property_driving_directions		= '';
		$this->property_airports				= '';
		$this->property_othertransport			= '';
		$this->property_policies_disclaimers	= '';
		$this->published						= 0;

		$this->error				= null;
		}
		
	function getProperty()
		{
		if ($this->id > 0 )
			{			
			$query = "SELECT 
				`id`,`property_id`,`crate_id`
				FROM #__jomresportal_properties_crates_xref WHERE `id`='$this->id' LIMIT 1";
				
			$result=doSelectSql($query);
			//var_dump($result);exit;
			if ($result && count($result)==1)
				{
				foreach ($result as $r)
					{
					$this->id					= $r->id;
					$this->property_id			= $r->property_id; 
					$this->crate_id				= $r->crate_id; 
					}
				return true;
				}
			else
				{
				if (count($result)==0)
					{
					$this->error = "No Properties were found with that id";
					return false;
					}
				if (count($result)> 1)
					{
					$this->error = "More than one Property was found with that id";
					return false;
					}
				}
			}			
		else
			{
			$this->error = "ID of Property not available";
			return false;
			}
		}	
	
	function commitNewProperty()
		{
		if ($this->id < 1 )
			{
			$query="INSERT INTO #__jomresportal_properties_crates_xref 
				(
				`property_id`,
				`crate_id`
				)
				VALUES
				(
				'$this->property_id',
				'$this->crate_id'
				)";
				//echo $query;exit;
			$result = doInsertSql($query,'');
			if ($result)
				{
				$this->id=$result;
				return true;
				}
			else
				{
				$this->error = "ID of Property could not be found after apparent successful insert";
				return false;
				}
			}
		$this->error = "ID of Property already available. Are you sure you are creating a new Property?";
		return false;
		}

	function commitUpdateProperty()
		{
		if ($this->id > 0 )
			{
			
			$query="UPDATE #__jomresportal_properties_crates_xref SET 
				`property_id` 			= '$this->property_id',
				`crate_id` 				= '$this->crate_id'
				WHERE `id`='$this->id'";
			return doInsertSql($query,'');
			}
			
		$this->error = "ID of Property not available";
		return false;
		}
	function commitUpdatePropertyByPropertyid()
		{
		if ($this->property_id > 0 )
			{
			$query="UPDATE #__jomresportal_properties_crates_xref SET 
				`crate_id` 				= '$this->crate_id'
				WHERE `property_id` 	= '$this->property_id'";
			return doInsertSql($query,'');
			}
			
		$this->error = "ID of Property not available";
		return false;
		}

	}

?>