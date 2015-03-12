# Dotted UBB #

![http://files.getdropbox.com/u/1056571/logo.small.png](http://files.getdropbox.com/u/1056571/logo.small.png)

Dotted UBB, short DUBB, is a new and fast way to style your text.
The usability is unique and has never been used before.
An introduction:

```
[The quick.{i} brown.{color(brown)} fox jumps over the lazy dog].{b, size(3)}
```

The render will give the follow output on your screen.

> ### **The _quick_**<font color='brown'>brown</font> fox jumps over the lazy dog**###**

## Features ##

You can style a (group) word(s) like the follow example:

```
word.{b}
```

If you want to style a single word, you put a dot after the word and then write braces.
Between the braces you put your style or styles.
You can divide multiple styles with a comma.

```
word.{b , i}
```

In the example above the word will be printed bold and italic.
If you want add a special style, example creating a link of the word.
You have to have some parameters like an URL address or more.
This is called a styletag function. You write the name of the styletag function and between
the parentheses you give the parameter(s).
Next is an example of a style function.

```
word.{url(http://www.google.com)}
```

If you have to pass more then one parameter, you can divide them by a comma.
You can use normal styletags (b, i, ...) and styletag functions on the same word without any order.

If you want to style more then one word, you can group the words between square brackets.
After the ] bracket you put the dot and the style(s) between the braces.

```
[This is my first wordgroup].{b , url(http://www.google.com , Google websearch!) , i}
```

The words "This is my first wordgroup" will be an URL to google.com with a title attribute.
The group of words will also be printed bold and italic.

Since version 1.1 you can group multiple lines together.

```
[foo
bar
baz].{b}
```

If you have large text to style, maybe to make your introduction bold, you can group it and style it.
You can also nest styletags, like follow example:

```
[foo bar.{b} baz].{i}
```

_"foo bar baz"_ is italic and _"bar"_ bold.
Je can also nest group in group, see follow example:

```
[Blandit crisare, facilisi autem feugiat suscipit illum feugiat eum, ut illum. 
Esse magna [te facilisi erat delenit et. Commodo in vel eros te in.].{b}
Nulla eu nonummy velit vel in, amet vulputate et eros tation nostrud vero, in aliquip amet, in facilisi feugait eu et. 
Qui vero eu blandit delenit facilisi magna consequat illum, ullamcorper tation.].{i}
```

The whole section is printed italic and the second sentence is also printed bold.

## List of default styletags ##

| **Name** | **Styletag function** | **explanation** |
|:---------|:----------------------|:----------------|
| b | No | Makes text bold |
| i | No | Makes text italic |
| color | Yes, one parameter | Color the text |
| url | Yes, two parameters | Creates an URL of the text with an title attribute |
| size | Yes, one parameter | Set the size of the text, h1 ... h6 |
| list | Yes, one or two parameter | Create a (un)ordered list |

## How to use in your PHP script(s)? ##

Before you can render text, you have to tell the DUBB class which styletags you want to use.
You can register the styletags with the function DUBB::registerTag($tag).
If you don't register any styletags, you're text will be plain and boring.

```
DUBB::registerTag('b')
```

If you want to register a styletag function, you need a second parameter for the registerTag($tag) function.
The second parameter tells DUBB how many parameters the function needs.

```
DUBB::registerTag('url' , 2);
```

If you want to register more then one styletags, you can use the function registerTags(array $tags).
See follow example:

```
DUBB::registerTags( array('b' , 'url' => 2) );
```

The function DUBB#render() will render the string you passed to the constructor.
It gives the styled string back. You can print it or save it or eat it.
I don't care as long it renders I'm happy.


Here you can see a small example, enjoy!

```
DUBB::registerTags(array('b' , 'i' , 'color' => 1));
$string = "blaat.{b} - [foo bar].{i, color(red)} :)";
$dubb = new DUBB($string);
echo $dubb->render();
```