<?php
/**
 * PHPWord
 *
 * @link        https://github.com/PHPOffice/PHPWord
 * @copyright   2014 PHPWord
 * @license     http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt LGPL
 */

namespace PhpOffice\PhpWord\Tests\Section\Table;

use PhpOffice\PhpWord\Section\Table\Cell;

/**
 * Test class for PhpOffice\PhpWord\Section\Table\Cell
 *
 * @coversDefaultClass \PhpOffice\PhpWord\Section\Table\Cell
 * @runTestsInSeparateProcesses
 */
class CellTest extends \PHPUnit_Framework_TestCase
{
    public function testConstruct()
    {
        $iVal = rand(1, 1000);
        $oCell = new Cell('section', $iVal);

        $this->assertInstanceOf('PhpOffice\\PhpWord\\Section\\Table\\Cell', $oCell);
        $this->assertEquals($oCell->getWidth(), null);
    }

    public function testConstructWithStyleArray()
    {
        $iVal = rand(1, 1000);
        $oCell = new Cell('section', $iVal, null, array('valign' => 'center'));

        $this->assertInstanceOf('PhpOffice\\PhpWord\\Style\\Cell', $oCell->getStyle());
        $this->assertEquals($oCell->getWidth(), null);
    }

    public function testConstructWithStyleString()
    {
        $iVal = rand(1, 1000);
        $oCell = new Cell('section', $iVal, null, 'cellStyle');

        $this->assertEquals($oCell->getStyle(), 'cellStyle');
    }

    public function testAddText()
    {
        $oCell = new Cell('section', 1);
        $element = $oCell->addText('text');

        $this->assertCount(1, $oCell->getElements());
        $this->assertInstanceOf('PhpOffice\\PhpWord\\Section\\Text', $element);
    }

    public function testAddTextNotUTF8()
    {
        $oCell = new Cell('section', 1);
        $element = $oCell->addText(utf8_decode('ééé'));

        $this->assertCount(1, $oCell->getElements());
        $this->assertInstanceOf('PhpOffice\\PhpWord\\Section\\Text', $element);
        $this->assertEquals($element->getText(), 'ééé');
    }

    public function testAddLink()
    {
        $oCell = new Cell('section', 1);
        $element = $oCell->addLink('http://www.google.fr', 'Nom');

        $this->assertCount(1, $oCell->getElements());
        $this->assertInstanceOf('PhpOffice\\PhpWord\\Section\\Link', $element);
    }

    public function testAddTextBreak()
    {
        $oCell = new Cell('section', 1);
        $oCell->addTextBreak();

        $this->assertCount(1, $oCell->getElements());
    }

    public function testAddListItem()
    {
        $oCell = new Cell('section', 1);
        $element = $oCell->addListItem('text');

        $this->assertCount(1, $oCell->getElements());
        $this->assertInstanceOf('PhpOffice\\PhpWord\\Section\\ListItem', $element);
        $this->assertEquals($element->getTextObject()->getText(), 'text');
    }

    public function testAddListItemNotUTF8()
    {
        $oCell = new Cell('section', 1);
        $element = $oCell->addListItem(utf8_decode('ééé'));

        $this->assertCount(1, $oCell->getElements());
        $this->assertInstanceOf('PhpOffice\\PhpWord\\Section\\ListItem', $element);
        $this->assertEquals($element->getTextObject()->getText(), 'ééé');
    }

    public function testAddImageSection()
    {
        $src = __DIR__ . "/../../_files/images/earth.jpg";
        $oCell = new Cell('section', 1);
        $element = $oCell->addImage($src);

        $this->assertCount(1, $oCell->getElements());
        $this->assertInstanceOf('PhpOffice\\PhpWord\\Section\\Image', $element);
    }

    public function testAddImageHeader()
    {
        $src = __DIR__ . "/../../_files/images/earth.jpg";
        $oCell = new Cell('header', 1);
        $element = $oCell->addImage($src);

        $this->assertCount(1, $oCell->getElements());
        $this->assertInstanceOf('PhpOffice\\PhpWord\\Section\\Image', $element);
    }

    public function testAddImageFooter()
    {
        $src = __DIR__ . "/../../_files/images/earth.jpg";
        $oCell = new Cell('footer', 1);
        $element = $oCell->addImage($src);

        $this->assertCount(1, $oCell->getElements());
        $this->assertInstanceOf('PhpOffice\\PhpWord\\Section\\Image', $element);
    }

    public function testAddSectionImageByUrl()
    {
        $oCell = new Cell('section', 1);
        $element = $oCell->addImage(
            'https://assets.mozillalabs.com/Brands-Logos/Thunderbird/logo-only/thunderbird_logo-only_RGB.png'
        );

        $this->assertCount(1, $oCell->getElements());
        $this->assertInstanceOf('PhpOffice\\PhpWord\\Section\\Image', $element);
    }

    public function testAddHeaderImageByUrl()
    {
        $oCell = new Cell('header', 1);
        $element = $oCell->addImage(
            'https://assets.mozillalabs.com/Brands-Logos/Thunderbird/logo-only/thunderbird_logo-only_RGB.png'
        );

        $this->assertCount(1, $oCell->getElements());
        $this->assertInstanceOf('PhpOffice\\PhpWord\\Section\\Image', $element);
    }

    public function testAddFooterImageByUrl()
    {
        $oCell = new Cell('footer', 1);
        $element = $oCell->addImage(
            'https://assets.mozillalabs.com/Brands-Logos/Thunderbird/logo-only/thunderbird_logo-only_RGB.png'
        );

        $this->assertCount(1, $oCell->getElements());
        $this->assertInstanceOf('PhpOffice\\PhpWord\\Section\\Image', $element);
    }

    public function testAddObjectXLS()
    {
        $src = __DIR__ . "/../../_files/documents/sheet.xls";
        $oCell = new Cell('section', 1);
        $element = $oCell->addObject($src);

        $this->assertCount(1, $oCell->getElements());
        $this->assertInstanceOf('PhpOffice\\PhpWord\\Section\\Object', $element);
    }

    public function testAddPreserveText()
    {
        $oCell = new Cell('header', 1);
        $element = $oCell->addPreserveText('text');

        $this->assertCount(1, $oCell->getElements());
        $this->assertInstanceOf('PhpOffice\\PhpWord\\Section\\Footer\\PreserveText', $element);
    }

    public function testAddPreserveTextNotUTF8()
    {
        $oCell = new Cell('header', 1);
        $element = $oCell->addPreserveText(utf8_decode('ééé'));

        $this->assertCount(1, $oCell->getElements());
        $this->assertInstanceOf('PhpOffice\\PhpWord\\Section\\Footer\\PreserveText', $element);
        $this->assertEquals($element->getText(), array('ééé'));
    }

    public function testCreateTextRun()
    {
        $oCell = new Cell('section', 1);
        $element = $oCell->createTextRun();

        $this->assertCount(1, $oCell->getElements());
        $this->assertInstanceOf('PhpOffice\\PhpWord\\Section\\TextRun', $element);
    }

    public function testAddCheckBox()
    {
        $oCell = new Cell('section', 1);
        $element = $oCell->addCheckBox('check1', 'text');

        $this->assertCount(1, $oCell->getElements());
        $this->assertInstanceOf('PhpOffice\\PhpWord\\Section\\CheckBox', $element);
    }


    public function testGetElements()
    {
        $oCell = new Cell('section', 1);

        $this->assertInternalType('array', $oCell->getElements());
    }
}
