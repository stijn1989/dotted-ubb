# Create a new DUBB styletag function #

In the DUBB/Tag package you see an PHP file named _Function.php_. This is an abstract PHP class. All styletag functions belongs to this class. The class implements the Tag interface but doesn't implements it's render() method! To create a new styletag fuction, you need to extend the abstract class and implement the render method.
The _Function_ class saves the parameters which are passed by throught the constructor.

## Code your styletag step-by-step ##

1) Create a new PHP file in the map /DUBB/Tag/ (you'll find other tags as well there). The name of the file is the name of your styletag. The first letter is a capital letter.

```
[/home/stijn/dubb/]$ touch DUBB/Tag/Url.php
```

2) Edit the PHP file and we need to include the Function class first. You can just copy/paste the code below.

```
<?php
include_once 'Tag' . DIRECTORY_SEPARATOR . 'Function.php';
```

3) Now we write the styletag class code. The classname is the same as the filename (DUBB\_Tag_as classprefix) and don't forget to extend the Function class._

```
class DUBB_Tag_Url extends DUBB_Tag_Function
{

}
```

4) We need to implement the _render($text)_ because the Function class doesn't do that and the Tag interface say we need to implement this or you're screwed. In the render($text) method you can call the parameters. For the _Url_ we have one parameters, the Url address. Parameters can be readed like this:

```
$this->_params[0]; //the first parameter
$this->_params[1]; //the second parameter
...
```

The render methode looks like this:

```
public function render($text)
{
    return '<a href="' . $this->_params[0] . '">' . $string . '</a>';
}
```

5) When the code is written, we can register the tag and test it!

```
DUBB::registerTag('url' , 1); //the 1 says we need one parameter!
```

### The final code ###

```
<?php
include_once 'Tag' . DIRECTORY_SEPARATOR . 'Function.php';

class DUBB_Tag_Url extends DUBB_Tag_Function
{
	
	
	public function render($string)
	{
		return '<a href="' . $this->_params[0] . '">' . $string . '</a>';
	}
	

}
```