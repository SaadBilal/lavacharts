<?php namespace Khill\Lavacharts\Configs;

/**
 * Horizontal Axis Properties Object
 *
 * An object containing all the values for the axis which can be
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
use Khill\Lavacharts\Exceptions\InvalidConfigProperty;

class HorizontalAxis extends Axis
{
    /**
     * @var bool Allow container to cutoff labels.
     */
    public $allowContainerBoundaryTextCutoff;

    /**
     * @var bool Slanted or normal labels.
     */
    public $slantedText;

    /**
     * @var int Angle of labels.
     */
    public $slantedTextAngle;

    /**
     * @var int Number of levels of alternation.
     */
    public $maxAlternation;

    /**
     * @var int Maximum number of labels.
     */
    public $maxTextLines;

    /**
     * @var int Minimum amount in pixels of space between labels.
     */
    public $minTextSpacing;

    /**
     * @var int Amount of labels to show.
     */
    public $showTextEvery;


    /**
     * Stores all the information about the horizontal axis. All options can be
     * set either by passing an array with associative values for option =>
     * value, or by chaining together the functions once an object has been
     * created.
     *
     * @param  array $options
     * @throws InvalidConfigValue
     * @throws InvalidConfigProperty
     * @return hAxis
     */
    public function __construct($config = array())
    {
        $this->options = array_merge(
            $this->options,
            array(
                'allowContainerBoundaryTextCutoff',
                'slantedText',
                'slantedTextAngle',
                'maxAlternation',
                'maxTextLines',
                'minTextSpacing',
                'showTextEvery',
            )
        );

        parent::__construct($config);
    }

    /**
     * Sets whether the container can cutoff the labels or not.
     *
     * If false, will hide outermost labels rather than allow them to be
     * cropped by the chart container. If true, will allow label cropping.
     *
     * This option is only supported for a discrete axis.
     *
     * @param boolean Status of allowing label cutoff
     *
     * @return hAxis
     */
    public function allowContainerBoundaryTextCutoff($cutoff)
    {
        if (is_bool($cutoff)) {
            $this->allowContainerBoundaryTextCutoff = $cutoff;
        } else {
            throw new InvalidConfigValue(
                $this->className,
                __FUNCTION__,
                'boolean'
            );
        }

        return $this;
    }

    /**
     * Sets whether the labels are slanted or not.
     *
     * If true, draw the axis text at an angle, to help fit more text
     * along the axis; if false, draw axis text upright. Default
     * behavior is to slant text if it cannot all fit when drawn upright.
     * Notice that this option is available only when the $this->textPosition is
     * set to 'out' (which is the default).
     *
     * This option is only supported for a discrete axis.
     *
     * @param boolean Status of label slant
     *
     * @return hAxis
     */
    public function slantedText($slant)
    {
        if (is_bool($slant) && $this->textPosition == 'out') {
            $this->slantedText = $slant;
        } else {
            throw new InvalidConfigValue(
                $this->className,
                __FUNCTION__,
                'boolean',
                'and textPosition must be "out"'
            );
        }

        return $this;
    }

    /**
     * Sets the angle of the axis text, if it's drawn slanted. Ignored if
     * axis.slantedText is false, or is in auto mode, and the chart decided to
     * draw the text horizontally.
     *
     * This option is only supported for a discrete axis.
     *
     * @param int Angle of labels
     *
     * @return hAxis
     */
    public function slantedTextAngle($angle)
    {
        if (is_int($angle) && Helpers::between(1, $angle, 90)) {
            $this->slantedTextAngle = $angle;
        } else {
            throw new InvalidConfigValue(
                $this->className,
                __FUNCTION__,
                'int',
                'between 1 - 90'
            );
        }

        return $this;
    }

    /**
     * Sets the horizontal axis maximum alternation.
     *
     * Maximum number of levels of axis text. If axis text labels
     * become too crowded, the server might shift neighboring labels up or down
     * in order to fit labels closer together. This value specifies the most
     * number of levels to use; the server can use fewer levels, if labels can
     * fit without overlapping.
     *
     * This option is only supported for a discrete axis.
     *
     * @param int Number of levels
     *
     * @return hAxis
     */
    public function maxAlternation($alternation)
    {
        if (is_int($alternation)) {
            $this->maxAlternation = $alternation;
        } else {
            throw new InvalidConfigValue(
                $this->className,
                __FUNCTION__,
                'int'
            );
        }

        return $this;
    }

    /**
     * Sets the maximum number of lines allowed for the text labels.
     *
     * Labels can span multiple lines if they are too long, and the nuber of
     * lines is, by default, limited by the height of the available space.
     *
     * This option is only supported for a discrete axis.
     *
     * @param int Number of lines
     *
     * @return hAxis
     */
    public function maxTextLines($maxTextLines)
    {
        if (is_int($maxTextLines)) {
            $this->maxTextLines = $maxTextLines;
        } else {
            throw new InvalidConfigValue(
                $this->className,
                __FUNCTION__,
                'int'
            );
        }

        return $this;
    }

    /**
     * Sets the minimum spacing, in pixels, allowed between two adjacent text
     * labels.
     *
     * If the labels are spaced too densely, or they are too long,
     * the spacing can drop below this threshold, and in this case one of the
     * label-unclutter measures will be applied (e.g, truncating the lables or
     * dropping some of them).
     *
     * This option is only supported for a discrete axis.
     *
     * @param int Amount in pixels
     *
     * @return hAxis
     */
    public function minTextSpacing($minTextSpacing)
    {
        if (is_int($minTextSpacing)) {
            $this->minTextSpacing = $minTextSpacing;
        } else {
            if (isset($this->textStyle['fontSize'])) {
                $this->minTextSpacing = $this->textStyle['fontSize'];
            } else {
                throw new InvalidConfigValue(
                    $this->className,
                    __FUNCTION__,
                    'int',
                    'or set via textStyle[\'fontSize\']'
                );
            }
        }

        return $this;
    }

    /**
     * Sets how many axis labels to show.
     *
     * 1 means show every label, 2 means show every other label, and so on.
     * Default is to try to show as many labels as possible without overlapping.
     *
     * This option is only supported for a discrete axis.
     *
     * @param int Number of labels
     *
     * @return hAxis
     */
    public function showTextEvery($showTextEvery)
    {
        if (is_int($showTextEvery)) {
            $this->showTextEvery = $showTextEvery;
        } else {
            throw new InvalidConfigValue(
                $this->className,
                __FUNCTION__,
                'int'
            );
        }

        return $this;
    }
}
