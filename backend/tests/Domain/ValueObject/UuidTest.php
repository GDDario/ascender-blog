<?php

declare(strict_types=1);

namespace Test\Domain\ValueObject;

use AscenderBlog\Domain\Exception\InvalidValueObjectException;
use AscenderBlog\Domain\ValueObject\Uuid;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class UuidTest extends TestCase
{
    #[DataProvider('validUuidProvider')]
    public function test_can_create_uuid_with_valid_values(string $value): void
    {
        $uuid = new Uuid($value);

        $this->assertSame($value, $uuid->toString());
    }

    #[DataProvider('invalidUuidProvider')]
    public function test_cannot_create_uuid_with_invalid_values(string $value): void
    {
        $this->expectException(InvalidValueObjectException::class);

        new Uuid($value);
    }

    public function test_returns_uuid_real_name(): void
    {
        $uuid = new Uuid('123e4567-e89b-12d3-a456-426614174000');

        $this->assertSame('Uuid', $uuid->getRealNameInWords());
    }

    public static function validUuidProvider(): array
    {
        return [
            'version_1' => ['123e4567-e89b-12d3-a456-426614174000'],
            'version_4_uppercase' => ['550E8400-E29B-41D4-A716-446655440000'],
            'version_8' => ['123e4567-e89b-82d3-b456-426614174000'],
        ];
    }

    public static function invalidUuidProvider(): array
    {
        return [
            'empty' => [''],
            'missing_hyphens' => ['123e4567e89b12d3a456426614174000'],
            'invalid_version' => ['123e4567-e89b-92d3-a456-426614174000'],
            'invalid_variant' => ['123e4567-e89b-12d3-c456-426614174000'],
            'invalid_characters' => ['zzze4567-e89b-12d3-a456-426614174000'],
        ];
    }
}
