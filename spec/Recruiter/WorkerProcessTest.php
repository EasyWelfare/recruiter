<?php

namespace Recruiter;

use PHPUnit\Framework\TestCase;

class WorkerProcessTest extends TestCase
{
    public function setUp(): void
    {
        $this->pid = 4242;

        $this->repository = $this->getMockBuilder('Recruiter\Worker\Repository')
            ->disableOriginalConstructor()
            ->getMock();
    }

    public function testIfNotAliveWhenIsNotAliveReturnsItself()
    {
        $process = $this->givenWorkerProcessDead();
        $this->assertInstanceOf('Recruiter\Worker\Process', $process->ifDead());
    }

    public function testIfNotAliveWhenIsAliveReturnsBlackHole()
    {
        $process = $this->givenWorkerProcessAlive();
        $this->assertInstanceOf('Sink\BlackHole', $process->ifDead());
    }

    public function testRetireWorkerIfNotAlive()
    {
        $this->repository
            ->expects($this->once())
            ->method('retireWorkerWithPid')
            ->with($this->pid);

        $process = $this->givenWorkerProcessDead();
        $process->cleanUp($this->repository);
    }

    public function testDoNotRetireWorkerIfAlive()
    {
        $this->repository
            ->expects($this->never())
            ->method('retireWorkerWithPid')
            ->with($this->pid);

        $process = $this->givenWorkerProcessAlive();
        $process->cleanUp($this->repository);
    }


    private function givenWorkerProcessAlive()
    {
        return $this->givenWorkerProcess(true);
    }

    private function givenWorkerProcessDead()
    {
        return $this->givenWorkerProcess(false);
    }

    private function givenWorkerProcess($alive)
    {
        $process = $this->getMockBuilder('Recruiter\Worker\Process')
            ->setMethods(['isAlive'])
            ->setConstructorArgs([$this->pid])
            ->getMock();

        $process->expects($this->any())
            ->method('isAlive')
            ->will($this->returnValue($alive));

        return $process;
    }
}
