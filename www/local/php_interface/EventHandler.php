<?
class EventHandler
{
    function OnBuildMenu(&$globalMenu, &$moduleMenu)
    {
        
      global $USER;
      
      $arCurGroups = $USER->GetUserGroupArray();
      $isManager = false;
      if (in_array(CONTENT_MANAGER_GROUP, $arCurGroups))
        $isManager = true;
        
      if (!$USER->isAdmin() || $isManager)
      {
        foreach($moduleMenu as $key => $item)
        {
            if ($item["title"] != "Новости")
                unset($moduleMenu[$key]);
        }
        
        foreach($globalMenu as $key => $item)
        {
            if ($key != "global_menu_content")
                unset($globalMenu[$key]);
        }       
        
      }  
        
        return true;
    }
    
    
    
    
    
    
    
    
    
}


?>