<?php namespace Khill\Lavacharts\Configs;

/**
 * Legend Properties Object
 *
 * An object containing all the values for the legend which can be
 * passed into the chart's options.
 *
 *
 * @category  Class
 * @package   Khill\Lavacharts\Configs
 * @author    Kevin Hill <kevinkhill@gmail.com>
 * @copyright (c) 2014, KHill Designs
 * @link      https://github.com/kevinkhill/LavaCharts GitHub Repository Page
 * @link      http://kevinkhill.github.io/LavaCharts/ GitHub Project Page
 * @license   http://opensource.org/licenses/GPL-3.0 GPLv3
 */

use Khill\Lavacharts\Helpers\Helpers;
use Khill\Lavacharts\Exceptions\InvalidConfigValue;

class Legend extends ConfigOptions
{
    /**
     * Position of the legend.
     *
     * @var string
     */
    public $position;

    /**
     * Alignment of the legend.
     *
     * @var string
     */
    public $alignment;

    /**
     * Text style of the legend.
     *
     * @var textStyle
     */
    public $textStyle;


    /**
     * Builds the legend object when passed an array of configuration options.
     *
     * @param  array Options for the legend
     * @throws InvalidConfigValue
     * @throws InvalidConfigProperty
     * @return legend
     */
    public function __construct($config = array())
    {
        $this->options = array(
            'position',
            'alignment',
            'textStyle'
        );

        parent::__construct($config);
    }

    /**
     * Sets the position of the legend.
     *
     * Can be one of the following:
     * 'right'  - To the right of the chart. Incompatible with the vAxes option.
     * 'top'    - Above the chart.
     * 'bottom' - Below the chart.
     * 'in'     - Inside the chart, by the top left corner.
     * 'none'   - No legend is displayed.
     *
     * @param string Location of legend
     *
     * @return legend
     */
    public function position($position)
    {
        $values = array(
            'right',
            'top',
            'bottom',
            'in',
            'none'
        );

        if (in_array($position, $values)) {
            $this->position = $position;
        } else {
            throw new InvalidConfigValue(
                $this->className,
                __FUNCTION__,
                'string',
                'with a value of '.Helpers::arrayToPipedString($values)
            );
        }

        return $this;
    }

    /**
     * Sets the alignment of the legend.
     *
     * Can be one of the following:
     * 'start'  - Aligned to the start of the area allocated for the legend.
     * 'center' - Centered in the area allocated for the legend.
     * 'end'    - Aligned to the end of the area allocated for the legend.
     *
     * Start, center, and end are relative to the style -- vertical or horizontal -- of the legend.
     * For example, in a 'right' legend, 'start' and 'end' are at the top and bottom, respectively;
     * for a 'top' legend, 'start' and 'end' would be at the left and right of the area, respectively.
     *
     * The default value depends on the legend's position. For 'bottom' legends,
     * the default is 'center'; other legends default to 'start'.
     *
     * @param string Alignment of the legend
     *
     * @return legend
     */
    public function alignment($alignment)
    {
        $values = array(
            'start',
            'center',
            'end'
        );

        if (in_array($alignment, $values)) {
            $this->alignment = $alignment;
        } else {
            throw new InvalidConfigValue(
                $this->className,
                __FUNCTION__,
                'string',
                'with a value of '.Helpers::arrayToPipedString($values)
            );
        }

        return $this;
    }

    /**
     * An object that specifies the legend text style.
     *
     * @param textStyle Style of the legend
     *
     * @return legend
     */
    public function textStyle($textStyle)
    {
        if (Helpers::isTextStyle($textStyle)) {
            $this->textStyle = $textStyle->getValues();
        } else {
            throw new InvalidConfigValue(
                $this->className,
                __FUNCTION__,
                'textStyle'
            );
        }

        return $this;
    }
}
