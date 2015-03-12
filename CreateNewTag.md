# Create a new DUBB styletag #

In the DUBB package you see an PHP file named _Tag.php_. This is a PHP interface. All styletags belongs to this interface. To create a new styletag, you need to implement the interface in your styletag code.

_note: if you want to create a styletag function, read the next wikipage!_

## Code your styletag step-by-step ##

1) Create a new PHP file in the map /DUBB/Tag/ (you'll find other tags as well there). The name of the file is the name of your styletag. The first letter is a capital letter.

```
[/home/stijn/dubb/]$ touch DUBB/Tag/Underline.php
```

2) Edit the PHP file and we need to include the Tag interface first. You can just copy/paste the code below.

```
<?php
include_once 'Tag.php';
```

3) Now we write the styletag class code. The classname is the same as the filename (DUBB\_Tag_as classprefix) and don't forget to implement the interface._

```
class DUBB_Tag_Underline implements DUBB_Tag
{

}
```

4) The _Tag_ interface says we need to implements the method _render($text)_ in our styletag class. The method is public (deuh :p) and has one parameter _$text_. $text is the text that need to be styled. That can be one word, a group of words or multiline grouped words.

```
public function render($text)
{
    return '<span style="text-decoration: underline;">' . $text . '</span>';
}
```

5) When the code is written, we can register the tag and test it!

```
DUBB::registerTag('underline');
```

### The final code ###

```
<?php
include_once 'Tag.php';

class DUBB_Tag_Underline implements DUBB_Tag
{

    public function render($text)
    {
        return '<span style="text-decoration: underline;">' . $text . '</span>';
    }

}
```