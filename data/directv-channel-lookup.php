<?
	require_once("define.php");
	
	function getDisplayChannelCategories($language = 'English') {
	
	    try {
	      
	        $sql = '
	            SELECT
	                *
	            FROM
	                DirectStar.DIRECTV_ChannelClassifications CATS   
	        ';

			// this portion is just like fetch on the parent except we use pdo
			$Conn = RV_Helper_PDO::connector(RV_Constants_Shard::DIRECTSTAR, true);
			$Stmt = $Conn->prepare($sql);
			$Stmt->execute();
			$Collection = $Stmt->fetchAll(PDO::FETCH_CLASS, "DB_Generic");
			$Collection = new RV_DatabaseCollection($Collection);
	        
	        $Cats = $Collection;
	
	    } catch (RV_Exception $e) {
	        echo "Test: " . $e->getMessage();
	    }
	
	    return $Cats;
	
	}
	
	function getDisplayChannelsByPackage($PackageName) {
	    return getDisplayChannels('English', $PackageName);
	}
	
	function getDisplayChannels($language = 'English', $PackageName = false) {
	
	    try {
	
	        $whereString = "";
	      
	        if($PackageName) {
	            $whereString .= " AND CP.PackageName = ".r3a($PackageName);
	        }
	
	        $sql = '
	            SELECT
	                CL.*,
	                GROUP_CONCAT(CLook.ChannelPackageID) AS ChannelPackageString,
	                GROUP_CONCAT(DISTINCT CATS.Description) AS CatsString
	            FROM
	                DirectStar.DIRECTV_ChannelLineup CL
	                LEFT JOIN DirectStar.DIRECTV_ChannelLookup CLook USING (ChannelLineupID)
	                LEFT JOIN DirectStar.DIRECTV_ChannelPackages CP ON (CLook.ChannelPackageID = CP.ChannelPackageID AND CP.PackageLanguage = ' . r3a($language) . ')
	                LEFT JOIN DirectStar.DIRECTV_ChannelClassificationLookup CATSL USING (ChannelLineupID)
	                LEFT JOIN DirectStar.DIRECTV_ChannelClassifications CATS USING (ChannelClassificationID)
	            WHERE
	                CP.ChannelPackageID IS NOT NULL
	                '.$whereString.'
	            GROUP BY
	                CL.ChannelLineupID
	            ORDER BY
	                CL.ChannelName
	        ';

			// this portion is just like fetch on the parent except we use pdo
			$Conn = RV_Helper_PDO::connector(RV_Constants_Shard::DIRECTSTAR, true);
			$Stmt = $Conn->prepare($sql);
			$Stmt->execute();
			$Collection = $Stmt->fetchAll(PDO::FETCH_CLASS, "DB_Generic");
			$Collection = new RV_DatabaseCollection($Collection);
	        
	        $Channels = $Collection;
	
	    } catch (RV_Exception $e) {
	        echo "Test: " . $e->getMessage();
	    }
	
	    foreach($Channels as $Channel) {
	        $Channel->Packages = explode(",",$Channel->ChannelPackageString);
	    }
	
	    return $Channels;
	
	}
	
	function getDisplayPackages($lang = 'English') {
	
	    try {
	        
	        //Setup Packages and Headers
	        $sql = "
	            SELECT
	                *
	            FROM
	                DirectStar.DIRECTV_ChannelPackages CP
	            WHERE
	                CP.PackageLanguage = " . r3a($lang) . "
	                AND CP.PackageName NOT IN ('Family')
	            ORDER BY
	                CP.RowNumber
	        ";

			// this portion is just like fetch on the parent except we use pdo
			$Conn = RV_Helper_PDO::connector(RV_Constants_Shard::DIRECTSTAR, true);
			$Stmt = $Conn->prepare($sql);
			$Stmt->execute();
			$Collection = $Stmt->fetchAll(PDO::FETCH_CLASS, "DB_Generic");
			$Collection = new RV_DatabaseCollection($Collection);
	
	        $Packages = $Collection;
	        
	    } catch (RV_Exception $e) {
	        echo "Test: " . $e->getMessage();
	    }
	
	    return $Packages;
	
	}
	
	function displayChannelLineup () {
	
		$language               =   'English';
		
	    if(isset($_GET['lang']) && $_GET['lang'] == 'es'){
	        $language           =   'Spanish';
	    }
	    
	    try {
	    	
		    //Setup Packages and Headers
	        $Channels = getDisplayChannels();
	        $Packages = getDisplayPackages();
		    
	    } catch (RV_Exception $e) {
	    	echo "Test: " . $e->getMessage();
	    }
	}
	
	$Categories = getDisplayChannelCategories();
	$Packages = getDisplayPackages('English');
    $Channels = getDisplayChannels();
    
	// $channelsJSON = array(
	
	// 	'Categories' => (array) $Categories,
	// 	'Packages' => (array) $Packages,
	// 	'Channels' => (array) $Channels
	// );
	
	// echo json_encode($channelsJSON);
	// exit;

?>