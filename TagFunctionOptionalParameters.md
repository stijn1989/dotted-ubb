# Create optional parameters in your styletag function #

Since version 1.4.1 of Dotted UBB you can use optional style parameters for your styletag function.

## Code optional parameter(s) step-by-step ##

Let's say we have the URL styletag function. The first parameter is ofcourse the URL which is required. You want to give the option to the user to add an title to his URL. This is the second parameter and is _optional_.

1) You need to check in your render() function if the optional parameter(s) are set.

```
public function render($text)
{
    if(isset($this->_params[1])) {
        return '<a href="' . $this->_params[0] . '" title="' . $this->_params[1] . '">' . $string . '</a>';
    } else { //no title set
        return '<a href="' . $this->_params[0] . '">' . $string . '</a>';
    }
}
```

2) You need to say in the register process of the tag that we have to amounts of parameters. The styletag function can have either one or two parameters. This is how you do it.

```
DUBB::registerTag('url' , array(1 , 2));
```