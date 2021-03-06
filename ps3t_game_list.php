<HTML>
<HEAD>
<TITLE>PS3Trophies.org Guide Template</TITLE>
<META name=VI60_defaultClientScript content=JavaScript>
<META http-equiv="Content-Type" Content="text/html; charset=UTF-16">
<META name="description" content="ps3trophies.org">
<META name="keywords" content="ps3trophies.org">

<link rel="stylesheet" type="text/css" href="ps3trophies.css">

</HEAD>

<BODY BGCOLOR=white>

<?php
    
    // Include the library
    include('simple_html_dom.php');
    
    // Get the variables from the selection
    $gamealpha = $_GET['alpha'];
    $gamesite = $_GET['site'];
    
    $forumnamecheck = 0;
    
    // Create gametype based on site
    if ($gamesite == 'ps3t') {
        
        // TEMP PS4 WORKAROUND
        //if ($gamealpha == 'ps4') {
        //	$siteurl = 'playstationtrophies.org';
        //	$linkreplace = '/trophies/';
        //	$numtypes = 0;
        //	$gametype[0] = 'ps4'; }
        //else {
        $siteurl = 'playstationtrophies.org';
        $linkreplace = '/trophies/';
        $numtypes = 4;
        $gametype[0] = 'ps4';
        $gametype[1] = 'retail';
        $gametype[2] = 'psn';
        $gametype[3] = 'vita';
        $gametype[4] = 'japanese';
        //	}
    }
    else {
        
        // TEMP XB1 WORKAROUND
        //if ($gamealpha == 'xb1') {
        //	$siteurl = 'xboxachievements.com';
        //	$linkreplace = '/achievements/';
        //	$numtypes = 0;
        //	$gametype[0] = 'xbox%20one'; }
        //else {
        $siteurl = 'xboxachievements.com';
        $linkreplace = '/achievements/';
        $numtypes = 7;
        $gametype[0] = 'xbox-one';
        $gametype[1] = 'arcade';
        $gametype[2] = 'retail';
        $gametype[3] = 'app';
        $gametype[4] = 'japanese';
        $gametype[5] = 'pc';
        $gametype[6] = 'win8';
        $gametype[7] = 'wp7';
        //	}
    }
    
    echo '<BR>';
    
    if ($gamesite == 'ps3t') {
        echo '<FONT COLOR=darkblue SIZE=3><B>PLAYSTATION TROPHIES</B>'; }
    else {
        echo '<FONT COLOR=darkgreen SIZE=3><B>XBOX ACHIEVEMENTS</B>'; }
    echo ' - ';
    
    if ($gamealpha == '-') {
        echo '0-9'; }
    else {
        echo strtoupper($gamealpha); }
    echo ' games</FONT><BR><BR>';
    
    // Retrieve the DOM from a given URL
    for ($i = 0; $i <= $numtypes; $i++) {
        
        if (($gametype[$i] == 'retail') && ($gamesite == 'ps3t')) {
            echo '<B>PS3 RETAIL</B><BR>'; }
        else if ($gametype[$i] == 'psn') {
            echo '<B>PS3 DIGITAL</B><BR>'; }
        else if ($gametype[$i] == 'xbox-one') {
            echo '<B>XBOX ONE</B><BR>'; }
        else if ($gametype[$i] == 'app') {
            echo '<B>APPLICATIONS</B><BR>'; }
        else 	{
            echo '<B>' . str_replace('%20',' ',strtoupper($gametype[$i])) . '</B><BR>'; }
        
        $nextpage = 1;
        
        for ($j = 1; $j <= 9; $j++) {
            
            $k = $j+1;
            
            // Only pull the next page if it exists
            if ($nextpage == 1) {
                
                // TEMP XB1 WORKAROUND
                //if ($gamealpha == 'xb1') {
                //	$html = file_get_html('http://www.' . $siteurl . '/games/' . $gametype[$i] .
                //		'/' . $j . '/'); }
                //else {
                $html = file_get_html('http://www.' . $siteurl . '/browsegames/' . $gametype[$i] .
                                      '/' . $gamealpha . '/' . $j);
                //	}
                $nextpage = 0;
                
                foreach($html->find('a') as $x) {
                    
                    if (strncmp($x->href, '/game/', 6) == 0) {
                        
                        if ($x->class == 'linkT') {
                            
                            $y = $x->href;
                            
                            // get the game name
                            $game = str_replace($linkreplace,'',str_replace('/game/','',$y));
                            
                            echo '<A HREF="ps3t_guide_template.php?site=' . $gamesite .
                            '&game=' . $game . '">';
                            
                            // remove any blank unnecessary spaces
                            $gamename = str_replace('&nbsp;','',$x->plaintext);
                            
                            if ($forumnamecheck) {
                                echo $gamename . '</A>';  }
                            else {
                                echo $gamename . '</A><BR>';  }
                            
                        }
                        
                    }	
                    
                    // FORUM LINK CHECK
                    if ((strncmp($x->href, '/forum/', 7) == 0) && ($forumnamecheck)) {
                        
                        if ($x->class == 'linkT') {
                            
                            $y = $x->href;
                            
                            // get the game name
                            $forum = str_replace('/forum/','',$y);
                            
                            echo '|<A HREF="http://www.' . $siteurl . $y . '" target="_blank">' . $forum . '</A><BR>';
                            
                        }
                        
                    }	
                    
                    // TEMP XB1 WORKAROUND
                    //if ($gamealpha == 'xb1') {
                    //	if ($x->href == '/games/xbox one/' . $k . '/') {
                    //		$nextpage = 1; } 
                    //}
                    //else {
                    if ($x->href == '/browsegames/' . $gametype[$i] . '/' . $gamealpha . '/' . $k) {
                        $nextpage = 1; }	
                    //}
                    
                }
                
            }
            
        }
        
        echo '<BR>';
        
        $html->clear(); 
        unset($html);
        
    }
    
?>   

<BR><BR>

</BODY>
</HTML>
