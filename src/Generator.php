<?php

namespace dovbysh\Fibonacci\Numbers;


class Generator
{
    private $n = 0;
    private $current = 0;

    private $p1;
    private $p2;

    public function __construct(int $n)
    {
        $this->n = $n;
    }

    public function calc():\Generator
    {
        if ($this->current === 0) {
            yield $this->current => 0;
            $this->next();
            $this->push(0);
        }
        if (!$this->isEnd() && ($this->current === 1 || $this->current === -1)) {
            yield $this->current => 1;
            $this->next();
            $this->push(1);
        }
        while (!$this->isEnd()) {
            if ($this->current>90 || $this->current<-90) {
                $v = bcadd($this->p1, $this->p2);
            } else {
                $v = $this->p1 + $this->p2;
            }
            if ($this->n > 0) {
                yield $this->current => $v;
            } elseif ($this->n < 0) {
                if ((abs($this->current) & 1) === 0) {
                    yield $this->current => $v * (-1);
                } else {
                    yield $this->current => $v;
                }
            }
            $this->next();
            $this->push($v);
        }
    }

    private function next()
    {
        if ($this->n >= 0) {
            $this->current++;
        } elseif ($this->n < 0) {
            $this->current--;
        }
    }

    private function push($v)
    {
        $this->p1 = $this->p2;
        $this->p2 = $v;
    }

    private function isEnd()
    {
        if (
            ($this->n >= 0 && $this->current > $this->n)
            || ($this->n < 0 && $this->current < $this->n)
        ) {
            return true;
        } else {
            return false;
        }
    }
}