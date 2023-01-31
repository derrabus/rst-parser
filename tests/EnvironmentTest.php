<?php

declare(strict_types=1);

namespace Doctrine\Tests\RST;

use Doctrine\RST\Configuration;
use Doctrine\RST\Environment;
use PHPUnit\Framework\TestCase;

/**
 * Unit testing for RST
 */
class EnvironmentTest extends TestCase
{
    public function testRelativeUrl(): void
    {
        $environment = new Environment(new Configuration());
        $environment->setCurrentFileName('path/to/something.rst');
        $environment->setCurrentDirectory('input/dir');

        self::assertSame('path/to/something.rst', $environment->getCurrentFileName());
        self::assertSame('input/dir', $environment->getCurrentDirectory());

        // Assert that rules of relative url are respected
        self::assertSame($environment->relativeUrl('test.jpg'), 'test.jpg');
        self::assertSame($environment->relativeUrl('/path/to/test.jpg'), 'test.jpg');
        self::assertSame($environment->relativeUrl('/path/x/test.jpg'), '../../path/x/test.jpg');
        self::assertSame($environment->relativeUrl('/test.jpg'), '../../test.jpg');
        self::assertSame($environment->relativeUrl('http://example.com/test.jpg'), 'http://example.com/test.jpg');
        self::assertSame($environment->relativeUrl('imgs/test.jpg'), 'imgs/test.jpg');
        self::assertSame($environment->relativeUrl('/imgs/test.jpg'), '../../imgs/test.jpg');
    }

    public function testAbsoluteUrl(): void
    {
        $environment = new Environment(new Configuration());
        $environment->setCurrentFileName('path/to/something.rst');
        $environment->setCurrentDirectory('input/dir');

        self::assertSame('/test', $environment->absoluteUrl('/test'));
        self::assertSame('path/to/test', $environment->absoluteUrl('test'));
    }

    public function testCanonicalUrl(): void
    {
        $environment = new Environment(new Configuration());
        $environment->setCurrentFileName('subdir1/subdir2/test.rst');

        self::assertSame($environment->canonicalUrl('subdir1/subdir2/test.rst'), 'subdir1/subdir2/test.rst');
        self::assertSame($environment->canonicalUrl('test.rst'), 'subdir1/subdir2/test.rst');
        self::assertSame($environment->canonicalUrl('../index.rst'), 'subdir1/index.rst');
        self::assertSame($environment->canonicalUrl('../../index.rst'), 'index.rst');
    }

    /** @dataProvider getTextsAndSlugs */
    public function testSlugify(string $text, string $expectedSlug): void
    {
        self::assertSame($expectedSlug, Environment::slugify($text));
    }

    /** @return iterable<string, array{string, string}> */
    public function getTextsAndSlugs(): iterable
    {
        yield 'empty string' => [
            '',
            '',
        ];

        yield 'string with white spaces only' => [
            '   ',
            '',
        ];

        yield 'already slugged text' => [
            'setting-up-a-database',
            'setting-up-a-database',
        ];

        yield 'English text' => [
            'Setting up a Database',
            'setting-up-a-database',
        ];

        yield 'Japanese text' => [
            'データベースをセットアップする',
            'detabesuwosettoappusuru',
        ];

        yield 'Ukrainian text' => [
            'Налаштування бази даних',
            'nalastuvanna-bazi-danih',
        ];
    }
}
