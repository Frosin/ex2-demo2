<?
class EventHandler
{
    function OnBuildMenu(&$globalMenu, &$moduleMenu)
    {
        
      global $USER;
      
      if (!$USER->isAdmin())
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