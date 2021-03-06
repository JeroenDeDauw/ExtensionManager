<?php

namespace ComposerPackages\Test;

use ComposerPackages\HtmlFormatter;

/**
 * @covers \ComposerPackages\HtmlFormatter
 *
 * @group ComposerPackages
 *
 * @licence GNU GPL v2+
 * @since 0.1
 *
 * @author mwjames
 */
class HtmlFormatterTest extends \PHPUnit_Framework_TestCase {

	/**
	 * @since 0.1
	 */
	public function newHtmlMock( $text ) {

		if ( !class_exists( 'Html' ) ) {
			$this->markTestSkipped( 'Html class is not available' );
		}

		$html = $this->getMockBuilder( '\Html' )
			->disableOriginalConstructor()
			->getMock();

		$html::staticExpects( $this->any() )
			->method( 'rawElement' )
			->will( $this->returnValue( $text ) );

		return $html;
	}

	/**
	 * @since 0.1
	 */
	public function newInstance( $text = 'Foo' ) {
		return new HtmlFormatter( $this->newHtmlMock( $text ) );
	}

	/**
	 * @since 0.1
	 */
	public function testCanConstruct() {
		$this->assertInstanceOf( '\ComposerPackages\HtmlFormatter', $this->newInstance() );
	}

	/**
	 * @since 0.1
	 */
	public function testCreateElement() {
		$this->assertInternalType( 'string', $this->newInstance()->createElement( 'Foo', 'Faa' ) );
	}

}
