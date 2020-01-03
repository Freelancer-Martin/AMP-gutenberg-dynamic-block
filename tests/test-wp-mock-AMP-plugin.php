<?php
/**
 * Tests WP_Mock_Demo_Plugin
 * 
 */

namespace Tests;

//use Mockery;
//use WP_Mock;

/**
 * Tests for the Router class.
 *
class TestCase extends WP_Mock\Tools\TestCase {

	use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;

} 
*/
//namespace Tests;
use XWP\BlockScaffolding\AtlanticCity;
use XWP\BlockScaffolding\AMP_Block_Validated_URL_Post_Type;
use WP_Mock\Tools\TestCase;
use WP_Mock;
use ReflectionMethod;

class AtlanticCityTest extends TestCase
{
    public function setUp(): void
    {
        WP_Mock::setUp();
    }
    public function tearDown(): void
    {
        WP_Mock::tearDown();
    }

    /**
     * @covers XWP\BlockScaffolding\AMP_Block_Validated_URL_Post_Type
     */
    public function testAMP_Block_Validated_URL_Post_Type()
    {
        $AMP_Block_Validated_URL_Post_Type = new AMP_Block_Validated_URL_Post_Type();
        $this->assertInstanceOf(AMP_Block_Validated_URL_Post_Type::class, $AMP_Block_Validated_URL_Post_Type);
    }

    /**
     * @covers XWP\BlockScaffolding\AMP_Block_Validated_URL_Post_Type::getHtmlOutput
     * @uses XWP\BlockScaffolding\AMP_Block_Validated_URL_Post_Type::getHtmlOutput
     */
    public function testGetHtmlOutput()
    {
        
        $AMP_Block_Validated_URL_Post_Type = new AMP_Block_Validated_URL_Post_Type();
        $method = new ReflectionMethod(AMP_Block_Validated_URL_Post_Type::class, 'getHtmlOutput');
        $method->setAccessible(true);
        $result = $method->invoke($AMP_Block_Validated_URL_Post_Type);
        $this->assertRegExp('/^<p id="atlantic">[a-zA-Z\s\.\',]*<\/p>$/', $result);

    }

    
    /**
     * @covers XWP\BlockScaffolding\AMP_Block_Validated_URL_Post_Type::run
     * @uses XWP\BlockScaffolding\AMP_Block_Validated_URL_Post_Type::run
     */
/*    
    public function test_special_function() 
    {
        WP_Mock::expectActionAdded( 'init', 'run', 10, 2 );
        WP_Mock::expectFilterAdded( 'init', 'run' );

        special_function();
    }
*/

    
  
}