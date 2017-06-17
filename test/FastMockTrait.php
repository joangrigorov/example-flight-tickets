<?php

trait FastMockTrait
{
    /**
     * @param string $className
     * @return PHPUnit_Framework_MockObject_MockObject
     */
    private function mock(string $className): PHPUnit_Framework_MockObject_MockObject
    {
        return $this->getMockBuilder($className)->disableOriginalConstructor()->getMock();
    }
}