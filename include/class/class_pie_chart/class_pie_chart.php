<?php

class piechart extends chart
{
        var $radius;
        var $final;
        var $Coords = array();
        var $links;
		var $filename;
        function piechart($r,$na,$el,$co,$filename)
        {
                $this->radius=$r;
                $this->elementnames=$na;
                $this->elements=$el;
                $this->colors=$co;
                $this->createimage();
				$this->filename=$filename;
        }
        function createimage()
        {
                $degree = 0;
                $this->calculate();
                $r=$this->radius;
                $image=imagecreate($r*3,$r*2);
                $white=imagecolorallocate($image,255,255,255);
                $black=imagecolorallocate($image,0,0,0);
                $ggg = imagecolorallocate($image,140,140,140);
                for ($k=0;$k<count($this->colors);$k++)
                {
                        $fillcolor[$k]=imagecolorallocate($image,$this->colornames[$this->colors[$k]][0],$this->colornames[$this->colors[$k]][1],$this->colornames[$this->colors[$k]][2]);
                }
                imagearc($image,$r,$r,$r*2-1,$r*2-1,0,360,$black);
                for ($j=0;$j<count($this->elements);$j++)
                {
                        $part = 360*$this->fractions[$j];
                        if (isset($x2)) $x3 = $x2; else $x3 = $r*2;
                        if (isset($y2)) $y3 = $y2; else $y3 = $r;
                        $degree+=360*$this->fractions[$j];
                        $x1 = $r;
                        $y1 = $r;
                        $x2 = $x1 + $x1*cos($degree*pi()/180);
                        $y2 = $y1 + $y1*sin($degree*pi()/180);
                        imageline($image,$x1,$y1,$x2,$y2,$black);
                        imagefill($image,$r+$r/9*cos(($degree+5)*pi()/180),$r+$r/9*sin(($degree+5)*pi()/180),$fillcolor[$j]);
                        if ($j>0) $LegendIndex =  $j-1; else $LegendIndex = count($this->elements) - 1;
                        imagefilledrectangle($image,2.1*$r,.7*$r+($r/15)*$j,2.12*$r+($r/25),.7*$r+5+($r/15)*$j,$fillcolor[$LegendIndex]);
                        imagestring($image,2,2.13*$r+$r/20,.71*$r+($r/15)*$j-2,$this->elements[$j]."-".$this->elementnames[$j],$black);
                        $x22 = round($x2,0);
                        $y22 = round($y2,0);
                        $x33 = round($x3,0);
                        $y33 = round($y3,0);
                        $Coo[$j]['coords'] = "$x1,$y1,$x22,$y22,$x33,$y33";
                        if ($part > 90)
                        {
                                for ($k=30;$k<$part;$k+=30)
                                {
                                     $tmpx = $r + round($r * cos(($degree+$k-$part)*pi()/180),0);
                                     $tmpy = $r + round($r * sin(($degree+$k-$part)*pi()/180),0);
                                     $Coo[$j]['coords'] .= ",$tmpx,$tmpy,";
                                }
                        }
                }
                        $this->final=$image;
                        $this->Coords = $Coo;
        }
        function draw()
        {
                        imagejpeg($this->final);
        }
        function setLink()
        {
        print "<map name=\"Map\">\n";
        for ($j=0;$j<count($this->elements);$j++)
                {
                        print "<area shape=\"poly\" coords=\"".$this->Coords[$j]['coords']."\" href=\"".$this->links[$j]."\">\n";
                }
        print "</map>\n";
        }
        function out($filename,$quality)
        {
                        imagejpeg($this->final,$filename,$quality);
        }
        function GenerateHtmlCode()
        {
                $filename = FILE_PATH.$this->filename;
                $this->out($filename,100);
                if ($this->links != "") print "<img src=\"$filename\" border=\"0\" usemap=\"#Map\">\n";
                else print "<img src=\"$filename\" border=\"0\">\n";
                if ($this->links != "") $this->setLink();
        }
		
		
}
?>