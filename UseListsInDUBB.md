# How to use a (un)ordered list in DUBB #

To use lists in DUBB you need to be sure you have the file ~List.php~ in the _Tag_ directory. It's in DUBB since version 1.4.1.

1) To create a list you need to be sure _list_ is registered in DUBB. Since the styletag function List uses a second optional parameter, you have to register it as follow.

```
DUBB::registerTag('list' , array(1 , 2));
```

2) A (un)ordered list has multiple list items, these list items are grouped between square brackets. List items are separated by the follow symbol ~|~. You can choose between _ol_ or _ul_ for the list type.

```
[list item 1 | list item 2 | list item 3].{list(ul)}
```

3) You can also change the list item style. Here's a overview of styles you can use for each list type.

| **ul** | **ol** |
|:-------|:-------|
| none | none |
| circle | decimal |
| disc | decimal-leading-zero |
| square | georgian |
|  | lower-alpha |
|  | lower-greek |
|  | lower-latin |
|  | upper-alpha |
|  | upper-latin |
|  | upper-roman |

For example:

```
[list item 1 | list item 2 | list item 3].{list(ul , square)}
```

4) You can create nested lists to.

```
[list item 1 | list item 2 [sub item 1 | sub item 2].list(ol) | list item 3].{list(ul)}
```

This create the follow output:

  * list item 1
  * list item 2
    1. sub item 1
    1. sub item 2
  * list item 3