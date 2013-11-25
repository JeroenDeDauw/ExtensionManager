<?php

namespace ComposerPackages\Test;

use ComposerPackages\TextBuilder;
use ComposerPackages\ArrayMapper;

/**
 * @covers \ComposerPackages\TextBuilder
 *
 * @group ComposerPackages
 *
 * @licence GNU GPL v2+
 * @since 0.1
 *
 * @author mwjames
 */
class TextBuilderTest extends \PHPUnit_Framework_TestCase {

	protected $mockContent = array(
		'packages' => array(
			array(
				"name"    => "foo",
				"version" => "1.0",
				"type"    => "library",
				"time"    => "2013-11-17 21:03:14",
				"require" => array(
					"bar" => "~0.1",
					"php" => ">=5.3.0"
				)
			)
		)
	);

	/**
	 * @since 0.1
	 */
	public function newMessageBuilderMock() {

		$messageBuilder = $this->getMockBuilder( '\ComposerPackages\MessageBuilder' )
			->disableOriginalConstructor()
			->setMethods( array( 'getText' ) )
			->getMock();

		$messageBuilder->expects( $this->any() )
			->method( 'getText' )
			->will( $this->returnValue( 'Foo' ) );

		return $messageBuilder;
	}

	/**
	 * @since 0.1
	 */
	public function newInstance( $contents = array() ) {

		$mapper = new ArrayMapper( $contents );

		return new TextBuilder( $mapper, $this->newMessageBuilderMock() );
	}

	/**
	 * @since 0.1
	 */
	public function testCanConstruct() {
		$this->assertInstanceOf( '\ComposerPackages\TextBuilder', $this->newInstance() );
	}

	/**
	 * @since 0.1
	 */
	public function testGetText() {
		$this->assertInternalType( 'string', $this->newInstance( $this->mockContent )->getText() );
	}

}