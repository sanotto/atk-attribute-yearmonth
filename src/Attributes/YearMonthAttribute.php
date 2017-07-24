<?php

namespace Sintattica\Atk\Attributes;

use Sintattica\Atk\Core\Tools;
use Sintattica\Atk\Utils\IpUtils;

/**
 * The YearMonth attribute  can be used to let the user enter 
 * Year and Month in the YYYY-MM form.
 *
 * @author Santiago Ottonello <sanotto@gmail.com>
 */
class YearMonth extends Attribute
{
    /**
     * Constructor.
     *
     * @param string $name attribute name
     * @param int $flags attribute flags.
     */
    public function __construct($name, $flags = 0)
    {
        parent::__construct($name, $flags);
        $this->setAttribSize(6);
    }

    /**
     * Fetch value.
     *
     * @param array $postvars post vars
     *
     * @return string fetched value
     */
    public function fetchValue($postvars)
    {
		return parent::fetchValue($postvars[$this->fieldName()]);
    }

    public function edit($record, $fieldprefix, $mode)
    {
        return parent::edit($record, $fieldprefix, $mode);
    }

    /**
     * Checks if the value is a valid YearMonth value.
     *
     * @param array $record The record that holds the value for this
     *                       attribute. If an error occurs, the error will
     *                       be stored in the 'atkerror' field of the record.
     * @param string $mode The mode for which should be validated ("add" or
     *                       "update")
     */
    public function validate(&$record, $mode)
    {
        // Check for valid ip string
        $strvalue = Tools::atkArrayNvl($record, $this->fieldName(), '');
        if ($strvalue != '' && $strvalue != '...') 
		{
            $year = substr($value, 0, 4);
			$month = substr($value, 5, 2);

 			if(!is_numeric($year) || !is_numeric($month))
			{
                Tools::triggerError($record, $this->fieldName(), 'error_not_a_valid_year_month');
			}
			if( ($month < 1) || ($month >12))
			{
                Tools::triggerError($record, $this->fieldName(), 'error_not_a_valid_month');
			}
			if( ($year < 1900) || ($year >2200))
			{
                Tools::triggerError($record, $this->fieldName(), 'error_not_a_valid_year');
			}

        }
        parent::validate($record, $mode);
    }

    /**
     * Converts the internal attribute value to one that is understood by the
     * database.
     *
     * @param array $rec The record that holds this attribute's value.
     *
     * @return string The database compatible value
     */
    public function value2db($rec)
    {
		$value= Tools::atkArrayNvl($rec, $this->fieldName());
        return $value; 
    }

    /**
     * Converts a database value to an internal value.
     *
     * @param array $rec The database record that holds this attribute's value
     *
     * @return mixed The internal value
     */
    public function db2value($rec)
    {
        // By default, return the plain ip number
        return Tools::atkArrayNvl($rec, $this->fieldName());
    }

    /**
     * Return the database field type of the attribute.
     *
     * @return string The 'generic' type of the database field for this attribute.
     */
    public function dbFieldType()
    {
        return 'int';
    }

    /**
     * Return the size of the field in the database.
     *
     * @return int The database field size
     */
    public function dbFieldSize()
    {
        return 6;
    }
}
