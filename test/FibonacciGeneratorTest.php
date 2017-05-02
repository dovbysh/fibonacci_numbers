<?php
use dovbysh\Fibonacci\Numbers\Generator;
use PHPUnit\Framework\TestCase;

class FibonacciGeneratorTest extends TestCase
{
    /**
     * @param int $n
     * @param array $expectedSeq
     * @dataProvider fixedProvider
     */
    public function testFixed(int $n, array $expectedSeq)
    {
        $gen = new Generator($n);

        $seq = [];
        foreach ($gen->calc() as $k => $v) {
            $seq[$k] = $v;
        }

        $this->assertEquals($expectedSeq, $seq);
    }

    public function fixedProvider()
    {
        return [
            [0, [0]],
            [1, [0, 1]],
            [2, [0, 1, 1]],
            [-1, [0, -1 => 1]],
            [-2, [0, -1 => 1, -2 => -1]]
        ];
    }

    public function testFibonnacci() {
        $n = 89;
        $positive = (new Generator($n))->calc();
        $negative = (new Generator($n*(-1)))->calc();

        $p1 = $positive->current();
        $this->assertEquals($p1, $negative->current());
        $negative->next();
        $positive->next();

        $p2 = $positive->current();
        $this->assertEquals($p2, $negative->current());
        $negative->next();
        $positive->next();

        while ($positive->valid()){
            $this->assertTrue($negative->valid());
            if ((abs($negative->key())&1)===0) {
                $this->assertLessThan(0, $negative->current());
            }
            $this->assertEquals($p1+$p2, $positive->current());
            $this->assertEquals(abs($negative->current()), $positive->current());
            $this->assertEquals(abs($negative->key()), $positive->key());

            $p1= $p2;
            $p2 = $positive->current();

            $positive->next();
            $negative->next();
        }
    }
}