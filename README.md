# Year Month Attribute

## A YYYY-MM/YYYYMM attribute for ATK9

This attribute lets you specify a month of a year in the following formats:

* YYYY-MM 
* YYYYMM

The default format is YYYY-MM, using the  AF_NOHYPHEN flag will change the display
to the non hyphened format.

## Using

Use it as any other atk Attribute with

```
	$this->add(new YearMonthAttribute('period', AF_NOHYPHEN));
```
## Why not using a simple numeric attribute instead of this?

Well, using YearMonth attribute will asure you that:

* No years below 1900 and above 2200 are entered.
* No month above 12 (i.e. 201714 will not be deemed valid).

## Data base store type

The value will be stored in an **int** column in the form YYYYMM where:

* YYYY Is the year in 4 digits precision (i.e. 2017)
* MM is the month

Thus 201701 is lower than 201702 and higher than 201612.
