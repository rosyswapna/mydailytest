<?php

/**
 Scott Mattocks 
 mttcks@hotmail.com
 August 4, 2003
 bar_graph.class
 **/

/**
 This class creates a bar graph of data.  The graph consists of
 two axis lines, two axis labels, markings and values on the y axis,
 labels for the categories, and bars representing the values.  
 The GD library is requied for using this class.  Do NOT forget to
 set the font path appropriately in the graph function.
 **/

class bar_graph {

   var $png_image;   // The image will be created in png format (resource id)
   var $font_size;   // The font size in pixels (int)
   var $font_color;  // The color to write the font in (array(int R, int G, int B))
   var $bg_color;    // The color for the background (array(int R, int G, int B))
   var $x_label;     // The label for the x axiz (string)
   var $y_label;     // The label for the y axis (string)
   var $x_tags;      // The array of tags to be written beneath each bar (array[string])
   var $y_interval;  // The interval between ticks on the y axis (int)
   var $key;         // Whether or not to create a key (boolean)
   var $bar_space;   // The spacing between bars/bar sets (int)
   var $bar_color;   // The color for the text of the graph (array(int R, int G, int B))
                     // If bar_color is a multi-dimension array, will be assumed to have
                     // one color for each data set
   var $data;        // The array of data values (array[int])
                     // If data is multi-dimension array, will be assumed to have
                     // multiple data sets for the same graph
   var $key_labels;  // An array of labels describing the data sets for a key
                     // BEWARE! The key currently overlaps the data
                     // I am working on that

   /**
    Constructor for bar graph
    **/
   function bar_graph($width, $height, $x_l, $y_l, $x_t, $y_i, $b_s, $d)
   {
      $this->x_label = $x_l;
      $this->y_label = $y_l;
      $this->x_tags = $x_t;
      $this->y_interval = $y_i;
      $this->bar_space = $b_s;
      $this->data = $d;
      $this->png_image = imagecreate($width, $height);

      // Set default image colors and font size
      $this->bar_color = imagecolorallocate($this->png_image, 0, 0, 0);
      $this->bg_color = imagecolorallocate($this->png_image, 255, 255, 255);
      $this->font_color = imagecolorallocate($this->png_image, 0, 0, 0);
      $this->font_size = 8;

      return TRUE;
   }

   /**
    Set the bar colors for the image
    **/
   function set_bar_color($color)
   {
      if(!is_array($color))
      {
         return FALSE;
      }
      else if(is_array($color[0]))
      {
         $this->bar_color = NULL;
         if(sizeof($this->data) != sizeof($color))
         {
            return FALSE;
         }
         for($i = 0; $i < sizeof($color); ++$i)
         {
          $this->bar_color[$i] = imagecolorallocate($this->png_image, $color[$i][0], $color[$i][1], $color[$i][2]);
         }
         return TRUE;
      }
      else
      {
         $this->bar_color = imagecolorallocate($this->png_image, $color[0], $color[1], $color[2]);
         return TRUE;
      }
   }

   /**
    Set font color for image
    **/
   function set_font_color($color)
   {
      $this->font_color = imagecolorallocate($this->png_image, $color[0], $color[1], $color[2]);
      return TRUE;
   }

   /**
    Set font size for image
    **/
   function set_font_size($size)
   {
      $this->font_size = $size;
      return TRUE;
   }

   /**
    Set background color for image
    **/
   function set_bg_color($color)
   {
      $this->bg_color = imagecolorallocate($this->png_image, $color[0], $color[1], $color[2]);
      return TRUE;
   }

   /**
    Set the labels for the key
    BEWARE! The key currently overlaps data!
    **/
   function key($labels)
   {
      if(sizeof($labels) !== sizeof($this->data))
      {
         return FALSE;
      }

      $this->key_labels = $labels;
      return TRUE;
   }

   /**
    Create and place all of the image components
    **/
   function graph()
   {
      // Set font path for True Type Fonts
      $FONT_PATH = ROOT_PATH."files/fonts/graph/tahoma.ttf";

      // Create colors
      $black = imagecolorallocate($this->png_image, 0, 0, 0);
      $white = imagecolorallocate($this->png_image, 255, 255, 255);

      // Set background to white
      imagefill($this->png_image, 0, 0, $this->bg_color);

      // Get values for placement of axis and labels
      $line_spacer = $this->font_size; 
      $font_width = $this->font_size; 

      // Need values to center labels
      $y_label_size = strlen($this->y_label) * $font_width;
      $x_label_size = strlen($this->x_label) * $font_width;
      $x_axis_x = (imagesx($this->png_image) - $x_label_size) / 2;
      $x_axis_y = imagesy($this->png_image) - .25 * $line_spacer;
      $y_axis_x = 1.25 * $line_spacer;
      $y_axis_y = (imagesy($this->png_image) + $y_label_size) / 2;

      // Add labels to image
      imagettftext($this->png_image, $this->font_size, 90, $y_axis_x, $y_axis_y, $this->font_color, $FONT_PATH, $this->y_label);
      imagettftext($this->png_image, $this->font_size, 0, $x_axis_x, $x_axis_y, $this->font_color, $FONT_PATH, $this->x_label);

      // Create axis lines
      $origin_x = $line_spacer * 4;
      $origin_y = imagesy($this->png_image) - $line_spacer * 3;
      $x_end = imagesx($this->png_image) - $line_spacer;
      $y_end = $line_spacer;

      // Create bars and labels
      $graph_width = $x_end - $origin_x;
      $graph_height = $origin_y - $y_end;

      // Check for multiple data sets
      if(is_array($this->data[0]))
      {
         $max_value = 0;
         $num_values = 0;
         $data_sets = sizeof($this->data);
         for($i = 0; $i < sizeof($this->data); ++$i)
         {
            for($j = 0; $j < sizeof($this->data[$i]); ++$j)
            {
               $max_value = $this->data[$i][$j] > $max_value ? $this->data[$i][$j] : $max_value;
               ++$num_values;
            }
         }
      }
      else
      {
         $max_value = max($this->data);
         $num_values = sizeof($this->data);
         $data_sets = 1;
      }

      $bar_width = round(($graph_width - $this->bar_space - ($this->bar_space * $data_sets)) / ($num_values + .5));
      $left = $origin_x + $this->bar_space - $bar_width;

      for($i = 0; $i < sizeof($this->data[0]); ++$i)
      {
         for($j = 0; $j < sizeof($this->data); ++$j)
         {
            if(!is_array($this->data[$j]))
            {
               settype($this->data[$j], 'array');
            }

            // Bar setup 
            $height = $this->data[$j][$i] / $max_value * ($graph_height - $line_spacer); // Line spacer for cussion
            $top = $origin_y - $height;
            $left += $bar_width; 
            $bottom = $origin_y;
            $right = $left + $bar_width;

            // Add bars and labels
            imagefilledrectangle($this->png_image, $left, $top, $right, $bottom, is_array($this->bar_color) ? $this->bar_color[$j] : $this->bar_color);
            if(!isset($this->data[$j+1][$i]))
            {
               $left += $this->bar_space;
            }
         }
      }

      // Label setup and adding
      $label_top = $origin_y + 1.25 * $line_spacer;
      $label_left = $origin_x + $this->bar_space + $bar_width * $data_sets * .5;
      for($k = 0; $k < sizeof($this->x_tags); ++$k)
      {
         $k_left = $label_left - strlen($this->x_tags[$k]) * 3;
         imagettftext($this->png_image, $this->font_size, 0, $k_left, $label_top, $this->font_color, $FONT_PATH, $this->x_tags[$k]); 
         $label_left += $this->bar_space + $bar_width * $data_sets;
      }

      // Draw axis last to be on top of bars
      imageline($this->png_image, $origin_x, $origin_y, $origin_x, $y_end, $this->font_color);
      imageline($this->png_image, $origin_x, $origin_y, $x_end, $origin_y, $this->font_color);

      // Add ticks 
      $tick_spacer = $this->y_interval / $max_value * ($graph_height - $line_spacer);
      for($i = 1; $i * $tick_spacer <= $graph_height; ++$i)
      {
         $tick_y = $origin_y - $tick_spacer * $i;
         imageline($this->png_image, $origin_x - 5, $tick_y, $origin_x, $tick_y, $this->font_color);
         imagettftext($this->png_image, $this->font_size, 90, $origin_x - 8, $tick_y + 6, $this->font_color, $FONT_PATH, $i * $this->y_interval);
      }

      // Add the key if needed
      if($this->key_labels !== NULL)
      {
         // Find longest label
         $longest = 0;
         for($i = 0; $i < sizeof($this->key_labels); ++$i)
         {
            $longest = strlen($this->key_labels[$i]) > strlen($this->key_labels[$longest]) ? $i : $longest;
         }
         
         // Set up key outline and dimensions
         $key_right = imagesx($this->png_image) - $line_spacer;
         $key_top = $line_spacer;
         $key_bottom = $key_top + $line_spacer + 2 * $line_spacer * sizeof($this->key_labels);
         $key_left = $key_right - 2 * $line_spacer - strlen($this->key_labels[$longest]) * $font_width;
         $box_left = $key_left + $line_spacer;
         $box_right = $box_left + $line_spacer;
         $text_left = $box_right + $line_spacer;

         // Finish alignment and add elements
         for($i = 0; $i < sizeof($this->key_labels); ++$i)
         {
            $box_top = $key_top + $line_spacer + 2 * $line_spacer * $i;
            $box_bottom = $box_top + $line_spacer;
            imagefilledrectangle($this->png_image, $box_left, $box_top, $box_right, $box_bottom, $this->bar_color[$i]);
            imagettftext($this->png_image, $this->font_size, 0, $text_left, $box_bottom, $this->font_color, $FONT_PATH, $this->key_labels[$i]);
         }
         imagerectangle($this->png_image, $key_left, $key_top, $key_right, $key_bottom, $this->font_color);
      }

      // Send headers and display image
      header("Content-Type: image/png");
      imagepng($this->png_image);

      return TRUE;
   }
}