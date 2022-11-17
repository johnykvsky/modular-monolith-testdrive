<?php

namespace Spisywarka\Application\Request;

use JMS\Serializer\Annotation\Type;
use Symfony\Component\Validator\Constraints as Assert;

final class CreateCategoryRequest
{
    /**
     * @Type("string")
     * @Assert\NotBlank()
     * @Assert\Length(max=255)
     */
    private string $name;

    public function __construct(string $name) {
        $this->name = $name;
    }

    public function name(): string
    {
        return $this->name;
    }
}
