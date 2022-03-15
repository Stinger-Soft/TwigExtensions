<?php

/*
 * This file is part of the Stinger Twig Extensions package.
 *
 * (c) Oliver Kotte <oliver.kotte@stinger-soft.net>
 * (c) Florian Meyer <florian.meyer@stinger-soft.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace StingerSoft\TwigExtensions;

use StingerSoft\PhpCommons\Formatter\ByteFormatter;
use StingerSoft\PhpCommons\Formatter\TimeFormatter;
use Symfony\Contracts\Translation\TranslatorInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

/**
 * Twig extension to pretty print objects, values, etc.
 *
 */
class PrettyPrintExtensions extends AbstractExtension {

	/**
	 *
	 * @var TranslatorInterface
	 */
	protected $translator;

	public function __construct(TranslatorInterface $translator) {
		$this->translator = $translator;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getFilters() {
		return [
			new TwigFilter('humanize_filesize', [$this, 'humanizeFileSizeFilter']),
			new TwigFilter('humanize_timediff', [$this, 'humanizeTimeDiffFilter']),
		];
	}

	/**
	 * Pretty prints a given memory size
	 *
	 * @param integer $size
	 *                          The memory size in bytes
	 * @param int     $precision
	 *                          The precision of the formatted value, default 2
	 * @param boolean $si
	 *                          Use SI prefixes? default false
	 * @param string  $locale
	 *                          Locale used to format the result, default 'en'
	 * @return string A pretty printed memory size
	 * @see ByteFormatter @codeCoverageIgnore
	 */
	public function humanizeFileSizeFilter($size, $precision = 2, $si = false, $locale = 'en'): string {
		return ByteFormatter::prettyPrintSize($size, $precision, $si, $locale);
	}

	/**
	 * Get the relative difference between a given start time and end time.
	 *
	 * Depending on the amount of time passed between given from and to, the difference between the two may be
	 * expressed in seconds, hours, days, weeks, months or years.
	 *
	 * @param int|\DateTime      $from
	 *            the start time, either as <code>DateTime</code> object or as integer expressing a unix timestamp,
	 *            used for calculating the relative difference to the given <code>to</code> parameter.
	 * @param int|\DateTime|null $to
	 *            the end time, either as <code>DateTime</code> object, a unix timestamp or <code>null</code> used for
	 *            calculating the difference to the given <code>from</code> parameter. In case <code>null</code> is
	 *            provided, the current timestamp will be used (utilizing <code>time()</code>).
	 * @return string
	 * @see TimeFormatter
	 *
	 */
	public function humanizeTimeDiffFilter($from, $to = null): string {
		$diff = TimeFormatter::getRelativeTimeDifference($from, $to);
		$since = null;
		switch($diff[1]) {
			case TimeFormatter::UNIT_SECONDS:
				$since = $this->translator->trans('stinger_soft.twig_extensions.pretty_print.time.seconds', [
					'%count%' => $diff[0],
				], 'StingerSoftTwigExtensions');
				break;
			case TimeFormatter::UNIT_MINUTES:
				$since = $this->translator->trans('stinger_soft.twig_extensions.pretty_print.time.minutes', [
					'%count%' => $diff[0],
				], 'StingerSoftTwigExtensions');
				break;
			case TimeFormatter::UNIT_HOURS:
				$since = $this->translator->trans('stinger_soft.twig_extensions.pretty_print.time.hours', [
					'%count%' => $diff[0],
				], 'StingerSoftTwigExtensions');
				break;
			case TimeFormatter::UNIT_DAYS:
				$since = $this->translator->trans('stinger_soft.twig_extensions.pretty_print.time.days', [
					'%count%' => $diff[0],
				], 'StingerSoftTwigExtensions');
				break;
			case TimeFormatter::UNIT_WEEKS:
				$since = $this->translator->trans('stinger_soft.twig_extensions.pretty_print.time.weeks', [
					'%count%' => $diff[0],
				], 'StingerSoftTwigExtensions');
				break;
			case TimeFormatter::UNIT_MONTHS:
				$since = $this->translator->trans('stinger_soft.twig_extensions.pretty_print.time.months', [
					'%count%' => $diff[0],
				], 'StingerSoftTwigExtensions');
				break;
			case TimeFormatter::UNIT_YEARS:
				$since = $this->translator->trans('stinger_soft.twig_extensions.pretty_print.time.years', [
					'%count%' => $diff[0],
				], 'StingerSoftTwigExtensions');
				break;
		}
		return $this->translator->trans('stinger_soft.twig_extensions.pretty_print.time.diff', [
			'%time%' => $since,
		], 'StingerSoftTwigExtensions');
	}

}
