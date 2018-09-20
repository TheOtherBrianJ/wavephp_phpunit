<?php

namespace WavePHP\Cheer;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class CheerleaderTest extends TestCase
{
    public function testGimmeAnG()
    {
        $cheerleader = new Cheerleader();
        $this->assertThat($cheerleader->gimmeAn('G'),
            $this->equalTo('G'));
    }

    /**
     * @test
     */
    public function gimmeAnO()
    {
        $cheerleader = new Cheerleader();
        $this->assertThat($cheerleader->gimmeAn('O'),
            $this->equalTo('O'));
    }

    /**
     * @test
     */
    public function testWhatsThatSpell()
    {
        $cheerleader = new Cheerleader();
        $cheerleader->gimmeAn('G');
        $cheerleader->gimmeAn('O');
        $this->assertThat($cheerleader->whatsThatSpell(),
            $this->equalTo('GO!'));
    }

    /**
     * @expectedException WavePHP\Cheer\LackOfFlexibilityException
     */
    public function testTheSplits()
    {
        $cheerleader = new Cheerleader();
        $cheerleader->doTheSplits();
    }

    public function testGimmeAnInvalidArg()
    {
        $cheerleader = new Cheerleader();
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('WavePHP\Cheer\Cheerleader::gimmeAn may only accept a single char arg');
        $this->expectExceptionCode(619);
        $cheerleader->gimmeAn("This is not a single character");
    }

    public function testPomShake()
    {
        $mockPom = $this->createMock(Pompom::class);
        $mockPom->expects($this->once())
            ->method('shake')
            ->willReturn(true);

        $cheerleader = new Cheerleader($mockPom);
        $cheerleader->whatsThatSpell();
    }

    public function testPomShakeFail()
    {
        $mockPom = $this->createMock(Pompom::class);
        $mockPom->expects($this->once())
            ->method('shake')
            ->willReturn(false);

        $this->expectException(PomShakeFailException::class);

        $cheerleader = new Cheerleader($mockPom);
        $cheerleader->whatsThatSpell();
    }

    /**
     * @dataProvider gimmeAnProvider
     */
    public function testGimmeAn($parameter, $expectedResponse)
    {
        $cheerleader = new Cheerleader();
        $this->assertThat($cheerleader->gimmeAn($parameter),
            $this->equalTo($expectedResponse));
    }

    public function gimmeAnProvider()
    {
        return [
            ['G', 'G'],
            ['O', 'O']
        ];
    }
}
