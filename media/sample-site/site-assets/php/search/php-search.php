<?php
/* Version 0.0.1 */

                

/* DocumentCollection.php 
namespace T4\PHPSearchLibrary\DocumentCollectionFactory;

use \SplFixedArray;

use \RuntimeException;
use \InvalidArgumentException;
use \LengthException;
use \OutOfBoundsException;
use \UnderflowException;
 */

class DocumentCollection
{
    private $documents = array();
    private $documentResults = array();
    private $paginatedDocumentResults = array();
    private $rankedDocuments = array();
    private $partialRankedDocuments = array();
    private $paginationState = false;
    private $wereResultsFound = false;
    private $queriesExist = false;
    private $totalNumberOfDocumentsInCollection = 0;
    private $numberOfDocumentResults = 0;
    private $currentPage = '';

    public function __construct($documents, Array $documentResults, $queriesExist)
    {
        $this->documents = $documents;
        $this->queriesExist = $queriesExist;
        $this->totalNumberOfDocumentsInCollection = count($documents);

        if (empty($documentResults)) {
            foreach ($this->documents as $key => $value) {
                $this->documentResults[$key] = $key;
            }
        } else {
            $this->wereResultsFound = true;
            $this->documentResults = $documentResults;
            $this->numberOfDocumentResults = count($this->documentResults);
        }
    }

    public function getDocuments()
    {
        return $this->documents;
    }

    private function setDocuments($documents)
    {
        $this->documents = $documents;
    }

    public function getDocumentResults()
    {
        return $this->documentResults;
    }

    public function setPaginatedDocumentResults($paginatedDocumentResults)
    {
        $this->paginatedDocumentResults = $paginatedDocumentResults;
    }

    public function getPaginatedDocumentResults()
    {
        return $this->paginatedDocumentResults;
    }

    public function wereResultsFound()
    {
        return $this->wereResultsFound;
    }

    private function setDocumentResults($documentResults)
    {
        $this->documentResults = $documentResults;
    }

    public function setPaginationState($state)
    {
        $this->paginationState = $state;
    }

    public function sort()
    {
        $numargs = func_num_args();
        $listargs = func_get_args();
        $sortedDocuments = array();
        $parameters = array();

        if (empty($this->documentResults)) {
            throw new UnderflowException("Result set is empty");
        }

        if(isset($this->documents[0]['rank'])) {
            if(func_get_arg(0) != 'rank' ) {
                $numargs += 2;
                $listargs = array_merge(array('rank',SORT_DESC),$listargs);
            }
        }


        foreach ($this->documentResults as $documentKey => $document) {
            for ($i = 0, $j = 0; $i < $numargs / 2; ++$i, $j+=2) {
                $sortedDocuments[$i][$documentKey] = mb_strtolower($this->documents[$documentKey][$listargs[$j % $numargs]]);
            }
        }

        for ($i = 0, $j = 0; $i < $numargs; ++$i) {
            if ($i % 2 === 0) {
                $parameters[] = $sortedDocuments[$j];
                ++$j;
            } else {
                $parameters[] = $listargs[$i];
            }
        }


        /* Conditional version check due to issue with PHP 5.3 */
        /* Log received: PHP Warning:  Parameter 1 to array_multisort() expected to be a reference */
        /* It appears this is due to using 'call_user_func_array' see: https://bugs.php.net/bug.php?id=49069 and https://bugs.php.net/bug.php?id=43568 */
        /* Quickfix below makes this function less dynamic but fixes the issue temporarily for PHP 5.3 */
        if (PHP_VERSION_ID >= 50400) {
            $parameters[] = &$this->documentResults;
            @call_user_func_array('array_multisort', $parameters);
        } else {
            if ($numargs === 2) {
                @array_multisort($parameters[0], $parameters[1], $this->documentResults);
            } elseif ($numargs === 4) {
                @array_multisort($parameters[0], $parameters[1], $parameters[2], $parameters[3], $this->documentResults);
            } elseif ($numargs === 6) {
                @array_multisort($parameters[0], $parameters[1], $parameters[2], $parameters[3], $parameters[4], $parameters[5], $this->documentResults);
            } elseif ($numargs === 8) {
                @array_multisort($parameters[0], $parameters[1], $parameters[2], $parameters[3], $parameters[4], $parameters[5], $parameters[6], $parameters[7], $this->documentResults);
            }
        }

        $this->setDocumentResults(array_combine($this->documentResults, $this->documentResults));
    }

    public function sliceDocumentResults($offset = 0, $length = 10)
    {
        if (!is_int($offset) || !is_int($length)) {
            throw new InvalidArgumentException("Both offset and length must be valid integers");
        }

        return array_slice($this->documentResults, $offset, $length, true);
    }

    public function displayResults($element)
    {
        if ($this->queriesExist && $this->wereResultsFound) {
            $this->outputResults($element);
        } elseif ($this->queriesExist && !$this->wereResultsFound) {
            return false;
        } else {
            $this->outputResults($element);
        }
    }

    private function outputResults($element)
    {
        if (empty($this->paginatedDocumentResults)) {
            foreach ($this->documentResults as $key => $value) {
                echo $this->documents[$key][$element];
            }
        } else {
            foreach ($this->paginatedDocumentResults as $key => $value) {
                echo $this->documents[$key][$element];
            }
        }
    }

    public function getDocumentElement($key, $element)
    {
        return $this->documents[$key][$element];
    }

    public function storePartialRankedDocuments($partialRankedDocuments)
    {
        $this->partialRankedDocuments[] = $partialRankedDocuments;
    }

    public function getTotalNumberOfDocumentsInCollection()
    {
        return $this->totalNumberOfDocumentsInCollection;
    }

    public function getNumberOfDocumentResults()
    {
        return $this->numberOfDocumentResults;
    }

    public function combineRankedResults()
    {
        $rankedResults = array();
        foreach ($this->partialRankedDocuments as $rankedSet) {
            if(!empty($rankedSet)) {
                foreach ($rankedSet as $key => $value) {
                    if(!isset($rankedResults[$key])) {
                        $rankedResults[$key] = 0;
                    }
                    $rankedResults[$key] += $value;
                }
            }
        }

        $this->setDocumentRanks($rankedResults);
    }

    private function setDocumentRanks($rankedResults)
    {
        $this->setDocuments($this->documents->toArray());
        foreach ($rankedResults as $documentKey => $rank) {
            $this->documents[$documentKey]['rank'] = $rank;
        }
        $this->setDocuments(SplFixedArray::fromArray($this->documents));
    }

    public function editDocuments($applyNowLinks)
    {
        $this->setDocuments($this->documents->toArray());

        foreach ($this->documentResults as $documentKey => $document) {
            $courseLevel = $this->documents[$documentKey]['courseLevel'];
            if (array_key_exists($courseLevel, $applyNowLinks)) {
                $this->documents[$documentKey]['HTMLResult'] = str_replace('-_-CourseLevelLink-_-', $applyNowLinks[$courseLevel], $this->documents[$documentKey]['HTMLResult']);
            } else {
                $this->documents[$documentKey]['HTMLResult'] = str_replace('-_-CourseLevelLink-_-', '', $this->documents[$documentKey]['HTMLResult']);
            }
        }

        $this->setDocuments(SplFixedArray::fromArray($this->documents));
    }
}
                
                

/* DocumentCollectionFactory.php 
namespace T4\PHPSearchLibrary;

use T4\PHPSearchLibrary\DocumentCollectionFactory\DocumentCollection;

use \RuntimeException;
use \InvalidArgumentException;
use \LengthException;
use \OutOfBoundsException;
use \UnderflowException;
 */

class DocumentCollectionFactory
{
    public static function getInstance($documentCollection, $documents, $documentResults, $doQuerysExist)
    {
        switch ($documentCollection) {
            case 'DocumentCollection':
                return new DocumentCollection($documents, $documentResults, $doQuerysExist);
                break;

            default:
                throw new RuntimeException('No instance of '.$documentCollection.' could be created');
                break;
        }
    }
}
                
                

/* DocumentsHandler.php 
namespace T4\PHPSearchLibrary\DocumentsHandlers\Abstracts;

use \RuntimeException;
use \InvalidArgumentException;
use \LengthException;
use \OutOfBoundsException;
use \UnderflowException;
 */

abstract class DocumentsHandler
{
    private $parsedDocuments;

    public function getParsedDocuments()
    {
        return $this->parsedDocuments;
    }

    public function setParsedDocuments($parsedDocuments)
    {
        $this->parsedDocuments = $parsedDocuments;
    }
}
                
                

/* JSONHandler.php 
namespace T4\PHPSearchLibrary\DocumentsHandlers;

use T4\PHPSearchLibrary\DocumentsHandlers\Abstracts\DocumentsHandler;

use \SplFixedArray;

use \RuntimeException;
use \InvalidArgumentException;
use \LengthException;
use \OutOfBoundsException;
use \UnderflowException;
 */

class JSONHandler extends DocumentsHandler
{
    private $connectionProtocol;
    private $documentsSource;
    private $jsonString;

    public function __construct($protocol, $documentsSource)
    {
        $this->documentsSource = rawurldecode(urldecode($documentsSource));

        if ($protocol === true) {
            $this->connectionProtocol = "https";
        } else {
            $this->connectionProtocol = "http";
        }

        $this->openJSONFile();
        $this->parseAndSetDocuments();
    }

    public function parseAndSetDocuments()
    {
        $jsonDecoded = json_decode($this->jsonString, true);

        if (json_last_error() != JSON_ERROR_NONE ) {

            switch (json_last_error()) {
                case JSON_ERROR_SYNTAX:
                    $error = 'Syntax error, malformed JSON'; 
                    if(preg_match_all("/(\\\\\\\\|\\\')/Ui",$this->jsonString) > 0) {
                        $error = 'Syntax error, JavaScript output converted twice';
                    }
                    
                break;
                default:
                    $error = 'Unknown error';
                break;
            }
            throw new RuntimeException("Invalid JSON: ".$error);   
        }

        $jsonArrayParentKey = array_keys($jsonDecoded);
        $jsonArrayParentKey = $jsonArrayParentKey[0];

        if(empty($jsonDecoded[$jsonArrayParentKey])) {
            throw new RuntimeException('JSON is empty');
        }

        $this->setParsedDocuments(SplFixedArray::fromArray($jsonDecoded[$jsonArrayParentKey]));
        unset($jsonDecoded);
    }

    private function openJSONFile()
    {
        $this->jsonString = @file_get_contents($_SERVER["DOCUMENT_ROOT"].$this->documentsSource);
        if ($this->jsonString === false) {
            $this->jsonString = @file_get_contents($this->connectionProtocol."://localhost".$this->documentsSource);
            if ($this->jsonString === false) {
                $this->jsonString = @file_get_contents($this->connectionProtocol."://$_SERVER[HTTP_HOST]".$this->documentsSource);
                if ($this->jsonString === false) {
                    $this->jsonString = null;
                    throw new RuntimeException("No JSON file found");
                }
            }
        }

        $this->sanitiseJSONString();
        $this->removeLastComma();
    }

    private function sanitiseJSONString()
    {
        $this->jsonString = preg_replace("/\\\'/Ui","'", $this->jsonString);
    }

    private function removeLastComma()
    {
        $position = strrpos($this->jsonString, ',');

        if ($position !== false) {
            $this->jsonString = substr_replace($this->jsonString, '', $position, strlen(','));
        }
    }
}
                
                

/* XMLHandler.php 
namespace T4\PHPSearchLibrary\DocumentsHandlers;

use T4\PHPSearchLibrary\DocumentsHandlers\Abstracts\DocumentsHandler;

use \XMLReader;
use \SplFixedArray;

use \RuntimeException;
use \InvalidArgumentException;
use \LengthException;
use \OutOfBoundsException;
use \UnderflowException;
 */

class XMLHandler extends DocumentsHandler
{
    private $connectionProtocol;
    private $documentsSource;
    private $xmlReader;

    const XML_ROOT_LEVEL = 1;
    const XML_NODE_LEVEL = 2;
    const XML_CHILD_LEVEL = 3;

    public function __construct($protocol, $documentsSource)
    {
        $this->documentsSource = rawurldecode(urldecode($documentsSource));

        if ($protocol === true) {
            $this->connectionProtocol = "https";
        } else {
            $this->connectionProtocol = "http";
        }

        $this->xmlReader = new XMLReader();
        $this->openXMLFile();
        // Set our iterating helper variables
        $keepReading = true;
        $previousDepth = self::XML_NODE_LEVEL;
        $pathArray;
        $pathString;
        $tempXMLArray;
        $tempNodeArray;
        $count = 0;

        // Go through the XML structure node by node
        while ($this->xmlReader->read()) {

            $currentDepth = $this->xmlReader->depth;

            // Pull out any beginning elements
            if ($this->xmlReader->nodeType === XMLREADER::ELEMENT && $currentDepth >= self::XML_NODE_LEVEL) {

                if ($currentDepth < $previousDepth) {
                    // If the current depth is shallower than the previous depth, remove last array index
                    array_pop($pathArray);
                }

                // Store the elements name in pathArray
                $pathArray[$currentDepth - self::XML_NODE_LEVEL] = $this->xmlReader->localName;
                $previousDepth = $currentDepth;

            } elseif (($this->xmlReader->nodeType === XMLREADER::CDATA || $this->xmlReader->nodeType === XMLREADER::TEXT) && $currentDepth >= self::XML_CHILD_LEVEL/* && $this->xmlReader->hasValue === true*/) {

                // Store the element value in tempArray with the current path as the key
                // Uses '__' to delimit depths in the XML document
                $tempNodeArray[implode('__', $pathArray)] = $this->xmlReader->value;

            } elseif ($this->xmlReader->nodeType === XMLREADER::END_ELEMENT && $currentDepth === self::XML_ROOT_LEVEL) {
                
                // Reached end of node, store data
                $tempXMLArray[$count] = $tempNodeArray;
                unset($tempNodeArray);
                ++$count;

            }
        }

        $this->xmlReader->close();

        $this->setParsedDocuments(SplFixedArray::fromArray($tempXMLArray));
        unset($tempXMLArray);
    }

    private function openXMLFile()
    {
        if ($this->xmlReader->open($_SERVER["DOCUMENT_ROOT"].$this->documentsSource) === false) {
            if ($this->xmlReader->open($this->connectionProtocol."://localhost".$this->documentsSource) === false) {
                if ($this->xmlReader->open($this->connectionProtocol."://$_SERVER[HTTP_HOST]".$this->documentsSource) === false) {
                    $this->xmlReader = null;
                    throw new RuntimeException("Failed to open XML file, check the filepath");
                }
            }
        }
    }
}
                
                

/* ExceptionFormatter.php 
namespace T4\PHPSearchLibrary;

use \RuntimeException;
use \InvalidArgumentException;
use \LengthException;
use \OutOfBoundsException;
use \UnderflowException;
use \Exception;
 */

class ExceptionFormatter
{
    public static function FormatException(Exception $exception, $before_html = "<div class=\"error\">", $after_html = "</div>")
    {
        echo $before_html.$exception->getMessage().$after_html;
    }
}
                
                

/* Facet.php 
namespace T4\PHPSearchLibrary\FacetFactory\Abstracts;

use T4\PHPSearchLibrary\DocumentCollectionFactory\DocumentCollection;
use T4\PHPSearchLibrary\QueryHandlerFactory\QueryHandler;

use \RuntimeException;
use \InvalidArgumentException;
use \LengthException;
use \OutOfBoundsException;
use \UnderflowException;
 */

abstract class Facet
{
    protected $documentCollection;
    protected $queryHandler;
    protected $documents;
    protected $documentResults;
    protected $multipleValueState = false;
    protected $multipleValueSeparator = ' ';
    protected $facetSource = 'results';
    protected $resultsSet;

    public function __construct(DocumentCollection $documentCollection, QueryHandler $queryHandler)
    {
        $this->documentCollection = $documentCollection;
        $this->queryHandler = $queryHandler;
    }

    protected function initialiseFacet()
    {
        $this->documents = $this->documentCollection->getDocuments();
        $this->documentResults = $this->documentCollection->getDocumentResults();

        if ($this->facetSource === 'results') {
            $this->resultSet = $this->documentResults;
        } elseif ($this->facetSource === 'documents') {
            $this->resultSet = $this->documents;
        } else {
            $this->resultSet = $this->documentResults;
        }
    }

    public function setMember($name, $value)
    {
        $this->$name = $value;
    }

    abstract public function displayFacet();
}
                
                

/* AtoZFacet.php 
namespace T4\PHPSearchLibrary\FacetFactory;

use T4\PHPSearchLibrary\FacetFactory\Abstracts\Facet; 

use \RuntimeException;
use \InvalidArgumentException;
use \LengthException;
use \OutOfBoundsException;
use \UnderflowException;
 */

class AtoZFacet extends Facet
{
    protected $element;
    protected $class = '';
    protected $id = '';
    protected $sortOrder = SORT_ASC;
    protected $isFirstOptionBlank = true;
    protected $firstOptionText = null;

    public function displayFacet()
    {
        $this->initialiseFacet();
        echo $this->outputFacet();
    }

    private function outputFacet()
    {
        $output = '';

        if (empty($this->id)) {
            $id = '';
        } else {
            $id = 'id="'.$this->id.'"';
        }

        if (empty($this->class)) {
            $class = '';
        } else {
            $class = 'class="'.$this->class.'"';
        }

        $output .= '<label for="select2">Select<select style="margin-left: -40px;" name="'.$this->element.'" id="select2" '.$class.'>';

        if ($this->isFirstOptionBlank) {
            if (!is_null($this->firstOptionText)) {
                $output .= '<option value="">'.$this->firstOptionText.'</option>';
            } else {
                $output .= '<option value="">Choose an option...</option>';
            }
        }
        if ($this->sortOrder === SORT_ASC) {
            foreach (range('a', 'z') as $letter) {
                $output .= '<option value="'.$letter.'"';
                if ($this->checkCurrentQuery($letter)) {
                    $output .= ' selected';
                }
                $output .= '>'.strtoupper($letter).'</option>';
            }
        } else {
            foreach (range('z', 'a') as $letter) {
                $output .= '<option value="'.$letter.'"';
                if ($this->checkCurrentQuery($letter)) {
                    $output .= ' selected';
                }
                $output .= '>'.strtoupper($letter).'</option>';
            }
        }

        $output .= '</select></label>';

        return $output;
    }

    private function checkCurrentQuery($item)
    {
        if ($this->queryHandler->isQuerySet($this->element)) {
            foreach ($this->queryHandler->getQueryValue($this->element) as $currentQuery) {
                if (mb_strtolower($item) === $currentQuery) {
                    return true;
                }
            }
        }
    }
}
                
                

/* DateFacet.php 
namespace T4\PHPSearchLibrary\FacetFactory;

use T4\PHPSearchLibrary\FacetFactory\Abstracts\Facet; 

use \RuntimeException;
use \InvalidArgumentException;
use \LengthException;
use \OutOfBoundsException;
use \UnderflowException;
 */

class DateFacet extends Facet
{
    private $listItems = array();
    protected $element;
    protected $class = '';
    protected $id = '';

    public function displayFacet()
    {
        $this->initialiseFacet();
        echo $this->outputFacet();
    }

    private function outputFacet()
    {
        $output = '';


        if (empty($this->id)) {
            $id = '';
        } else {
            $id = $this->id;
        }

        if (empty($this->class)) {
            $class = '';
        } else {
            $class = 'class="'.$this->class.'"';
        }

        $valueText = array();
        if ($this->queryHandler->isQuerySet($this->element)) {
            $valueText = $this->queryHandler->getQueryValue($this->element);
        }
        if (isset($valueText[0])) {
            $value = 'value="'.$valueText[0].'"';
        } else {
            $value = 'value=""';
        }

        $output .= '<label  class="visuallyhidden" for="'.$id.'">Select Date
        <input type="date" name="'.$this->element.'"  id="'.$id.'" '.$class.' '.$value.' />';
        $output .= '</label>';

        return $output;
    }
}
                
                

/* DropdownFacet.php 
namespace T4\PHPSearchLibrary\FacetFactory;

use T4\PHPSearchLibrary\FacetFactory\Abstracts\Facet; 

use \RuntimeException;
use \InvalidArgumentException;
use \LengthException;
use \OutOfBoundsException;
use \UnderflowException;
 */

class DropdownFacet extends Facet
{
    private $listItems = array();
    protected $element;
    protected $class = '';
    protected $id = '';
    protected $sortingState = false;
    protected $sortOrder = SORT_ASC;
    protected $isFirstOptionBlank = true;
    protected $firstOptionText = null;
    protected $customSortByKey = array();
    protected $customSortByName = array();

    public function displayFacet()
    {
        $this->initialiseFacet();

        foreach ($this->resultSet as $documentKey => $document) {
            $facetValues[] = $this->documentCollection->getDocumentElement($documentKey, $this->element);
        }

        // Multiple values in the one element e.g. multiple campuses
        if ($this->multipleValueState) {
            foreach ($facetValues as $value) {
                if (mb_strpos($value, $this->multipleValueSeparator) !== false) {
                    $facetMultiples = explode($this->multipleValueSeparator, $value);
                    if(is_array($facetMultiples)) {
                        foreach ($facetMultiples as $multipleValue) {
                            $additionalValues[] = trim($multipleValue);
                        }
                    }
                } else {
                    $additionalValues[] = trim($value);
                }
            }
            $facetValues = $additionalValues;
        }
        if(!empty($facetValues)) {
            $this->listItems = array_unique($facetValues);
            $this->listItems = array_filter($this->listItems);

            if ($this->sortingState) {
                if(!empty($this->customSortByName)) {

                    usort($this->listItems, function ($a, $b) {
                        $pos_a = array_search($a, $this->customSortByName);
                        $pos_b = array_search($b, $this->customSortByName);
                        $result = false;
                        if ($pos_a !== false && $pos_b === false) {
                            $result = -1;
                        } else if ($pos_b !== false && $pos_a === false) {
                            $result = 1;
                        } else if ($pos_b === false && $pos_a === false) {
                            $result = strcmp($a, $b);
                        } else {
                            $result = $pos_a - $pos_b;
                        }
                        return $result;
                    });

                      
                } elseif(!empty($this->customSortByKey)) {

                    sort($this->listItems);

                    $keys = array_keys($this->listItems);

                    $sortOrder = array(); 

                    foreach ($this->customSortByKey as $key => $value) {
                        $sortOrder[$key] = $keys[$value];
                    }

                    uksort($this->listItems, function ($a, $b) use ($sortOrder) {
                        $pos_a = array_search($a, $sortOrder);
                        $pos_b = array_search($b, $sortOrder);
                        $result = false;
                        if ($pos_a !== false && $pos_b === false) {
                            $result = -1;
                        } else if ($pos_b !== false && $pos_a === false) {
                            $result = 1;
                        } else if ($pos_b === false && $pos_a === false) {
                            $result = strcmp($a, $b);
                        } else {
                            $result = $pos_a - $pos_b;
                        }
                        return $result;
                    });
                      
                } else {
                    if ($this->sortOrder === SORT_ASC) {
                        asort($this->listItems);
                    } else {
                        arsort($this->listItems);
                    }
                }
            }

            echo $this->outputFacet();
        }
    }

    private function outputFacet()
    {
        $output = '';

        if (empty($this->id)) {
            $id = '';
        } else {
            $id = 'id="'.$this->id.'"';
        }

        if (empty($this->class)) {
            $class = '';
        } else {
            $class = 'class="'.$this->class.'"';
        }

        $output .= '<label for="select"><span class="select-text">Select</span><select name="'.$this->element.'" id="select" '.$class.'>';

        if ($this->isFirstOptionBlank) {
            if (!is_null($this->firstOptionText)) {
                $output .= '<option value="">'.$this->firstOptionText.'</option>';
            } else {
                $output .= '<option value="">Choose an option...</option>';
            }
        }

        foreach ($this->listItems as $item) {
            if ($this->checkCurrentQuery($item)) {
                $output .= '<option value="'.$item.'" selected>';
            } else {
                $output .= '<option value="'.$item.'">';
            }

            $output .= $item.'</option>';
        }

        $output .= '</select></label>';

        return $output;
    }

    private function checkCurrentQuery($item)
    {
        if ($this->queryHandler->isQuerySet($this->element)) {
            foreach ($this->queryHandler->getQueryValue($this->element) as $currentQuery) {
                if (mb_strtolower($item) === $currentQuery) {
                    return true;
                }
            }
        }
    }
}
                
                

/* ListFacet.php 
namespace T4\PHPSearchLibrary\FacetFactory;

use T4\PHPSearchLibrary\FacetFactory\Abstracts\Facet; 

use \RuntimeException;
use \InvalidArgumentException;
use \LengthException;
use \OutOfBoundsException;
use \UnderflowException;
 */

class ListFacet extends Facet
{
    private $i = 0;
    protected $element;
    protected $labelClass = 'checkbox-label';
    protected $sortingState = false;
    protected $sortOrder = SORT_ASC;
    protected $displayLimit = null;
    protected $capitaliseTerm = false;
    protected $fieldType = 'checkbox';
    protected $customSortByKey = array();
    protected $customSortByName = array();
    protected $beforeSingleHTML = '';
    protected $afterSingleHTML = '';
    protected $beforeHTML = '';
    protected $afterHTML = '';

    public function displayFacet()
    {
        $this->initialiseFacet();
        $this->listItems = array();
        $this->checkLimit();

        foreach ($this->resultSet as $documentKey => $document) {
            $facetValues[] = $this->documentCollection->getDocumentElement($documentKey, $this->element);
        }

        // Multiple values in the one element e.g. multiple campuses
        if ($this->multipleValueState) {
            if(is_array($facetValues)) {
                foreach ($facetValues as $value) {
                    if (mb_strpos($value, $this->multipleValueSeparator) !== false) {
                        $facetMultiples = explode($this->multipleValueSeparator, $value);
                        if(is_array($facetMultiples)) {
                            foreach ($facetMultiples as $multipleValue) {
                                $additionalValues[] = trim($multipleValue);
                            }
                        }
                    } else {
                        $additionalValues[] = trim($value);
                    }
                }
                $facetValues = $additionalValues;
            }
        }
        if(!empty($facetValues)) {
            $this->listItems = array_unique($facetValues);
            $this->listItems = array_filter($this->listItems);

            if ($this->capitaliseTerm === true) {
                $this->capitaliseTerms();
            }

            if ($this->sortingState) {
                if(!empty($this->customSortByName)) {

                    usort($this->listItems, function ($a, $b) {
                        $pos_a = array_search($a, $this->customSortByName);
                        $pos_b = array_search($b, $this->customSortByName);
                        $result = false;
                        if ($pos_a !== false && $pos_b === false) {
                            $result = -1;
                        } else if ($pos_b !== false && $pos_a === false) {
                            $result = 1;
                        } else if ($pos_b === false && $pos_a === false) {
                            $result = strcmp($a, $b);
                        } else {
                            $result = $pos_a - $pos_b;
                        }
                        return $result;
                    });

                      
                } elseif(!empty($this->customSortByKey)) {

                    sort($this->listItems);

                    $keys = array_keys($this->listItems);

                    $sortOrder = array(); 

                    foreach ($this->customSortByKey as $key => $value) {
                        $sortOrder[$key] = $keys[$value];
                    }

                    uksort($this->listItems, function ($a, $b) use ($sortOrder) {
                        $pos_a = array_search($a, $sortOrder);
                        $pos_b = array_search($b, $sortOrder);
                        $result = false;
                        if ($pos_a !== false && $pos_b === false) {
                            $result = -1;
                        } else if ($pos_b !== false && $pos_a === false) {
                            $result = 1;
                        } else if ($pos_b === false && $pos_a === false) {
                            $result = strcmp($a, $b);
                        } else {
                            $result = $pos_a - $pos_b;
                        }
                        return $result;
                    });
                      
                } else {
                    if ($this->sortOrder === SORT_ASC) {
                        asort($this->listItems);
                    } else {
                        arsort($this->listItems);
                    }
                }
            }
            
            echo $this->generateList();
        }
    }

    private function checkLimit()
    {
        if ($this->displayLimit <= 0) {
            $this->displayLimit = null;
        }
    }

    private function capitaliseTerms()
    {
        foreach ($this->listItems as &$term) {
            $term = ucfirst($term);
        }
    }

    private function generateList()
    {
        $this->i = 0;
        $output = '';
        $output .= $this->beforeHTML;
        foreach ($this->listItems as $item) {
            if ($this->i >= $this->displayLimit && !is_null($this->displayLimit)) {
                break;
            }
            if (empty($this->labelClass)) {
                $class = '';
            } else {
                $class = 'class="'.$this->labelClass.'"';
            }
            
            $id = strtolower(preg_replace('~-+~', '-',trim(preg_replace('~[^-\w]+~', '', iconv('utf-8', 'us-ascii//TRANSLIT', preg_replace('~[^\pL\d]+~u', '-', $item))), '-')));

            $output .= $this->beforeSingleHTML.'<label '.$class.' for="'.$id.'">'.$item.'';

            if ($this->checkCurrentQuery($item)) {
                $output .= '<input style="float:left;" type="'.$this->fieldType.'" id="'.$id.'" value="'.$item.'" data-cookie="T4_persona" name="'.$this->element.'" checked>';
            } else {
                $output .= '<input style="float:left;" type="'.$this->fieldType.'" id="'.$id.'" value="'.$item.'" data-cookie="T4_persona" name="'.$this->element.'">';
            }

            $output .= '</label>'.$this->afterSingleHTML;
            $this->i++;
        }
        $output .= $this->afterHTML;
        return $output;
    }

    private function checkCurrentQuery($item)
    {
        if ($this->queryHandler->isQuerySet($this->element)) {
            foreach ($this->queryHandler->getQueryValue($this->element) as $currentQuery) {
                if (mb_strtolower($item) === $currentQuery) {
                    return true;
                }
            }
        }
    }
}
                
                

/* RangeFacet.php 
namespace T4\PHPSearchLibrary\FacetFactory;

use T4\PHPSearchLibrary\FacetFactory\Abstracts\Facet; 

use \RuntimeException;
use \InvalidArgumentException;
use \LengthException;
use \OutOfBoundsException;
use \UnderflowException;
 */

class RangeFacet extends Facet
{
    private $rangeItems = array();
    private $min = 0;
    private $max = 100;
    private $value = 0;
    protected $element;
    protected $class = '';
    protected $id = '';
    protected $step = 1;

    public function displayFacet()
    {
        $this->initialiseFacet();

        $this->initialiseRanges();

        if ($this->queryHandler->isQuerySet($this->element)) {
            $this->value = $this->queryHandler->getQueryValue($this->element);
            $this->value = $this->value[0];
        }

        echo $this->outputFacet();
    }

    private function initialiseRanges()
    {
        foreach ($this->resultSet as $documentKey => $document) {
            $facetValues[] = $this->documentCollection->getDocumentElement($documentKey, $this->element);
        }

        // Multiple values in the one element e.g. cost of course 5000-10000
        if ($this->multipleValueState) {
            foreach ($facetValues as $value) {
                if (mb_strpos($value, $this->multipleValueSeparator) !== false) {
                    $facetMultiples = explode($this->multipleValueSeparator, $value);
                    foreach ($facetMultiples as $multipleValue) {
                        $additionalValues[] = $multipleValue;
                    }
                } else {
                    $additionalValues[] = $value;
                }
            }
            $facetValues = $additionalValues;
        }

        $this->rangeItems = array_unique($facetValues);
        $this->rangeItems = array_filter($this->rangeItems);

        foreach ($this->rangeItems as $index => $value) {
            $this->rangeItems[$index] = str_replace(array('$', '£', '€', ',', '.'), '', $this->rangeItems[$index]);
        }

        asort($this->rangeItems);

        $this->min = array_shift($this->rangeItems);
        $this->max = array_pop($this->rangeItems);

        $this->validateRange();
    }

    private function validateRange()
    {
        if (is_null($this->min) || $this->min < 0) {
            $this->min = 0;
        }
        if (is_null($this->max) || $this->max < 0) {
            $this->max = 0;
        }
        if ($this->max < $this->min) {
            $this->max = $this->min;
        }
    }

    private function outputFacet()
    {
        $output = '';

        if (empty($this->class)) {
            $class = '';
        } else {
            $class = 'class="'.$this->class.'"';
        }

        if (empty($this->id)) {
            $id = '';
        } else {
            $id = 'id="'.$this->id.'"';
        }

        $output .= '<label class="visuallyhidden" for="'.$this->id.'">'.$this->id.'</label><input '.$class.' '.$id.' name="'.$this->element.'" type="range" min="'.$this->min.'" max="'.$this->max.'" value="'.$this->value.'" step="'.$this->step.'" />';
    
        return $output;
    }

    public function getRangeValues()
    {
        $this->initialiseFacet();
        $this->initialiseRanges();
        return array($this->min, $this->max);
    }
}
                
                

/* RelatedTermsFacet.php 
namespace T4\PHPSearchLibrary\FacetFactory;

use T4\PHPSearchLibrary\FacetFactory\Abstracts\Facet; 

use \RuntimeException;
use \InvalidArgumentException;
use \LengthException;
use \OutOfBoundsException;
use \UnderflowException;
 */

class RelatedTermsFacet extends Facet
{
    private $i = 0;
    private $relatedTerms;
    protected $stopWords = array('/\bba\b/is', '/\band\b/is', '/\bof\b/is', '/\bin\b/is', '/\bor\b/is', '/\bwith\b/is', '/\bthe\b/is', '/\bat\b/is');
    protected $relatedTermsSource = '';
    protected $elementToSearchBy = '';
    protected $resultLimit = 10;
    protected $displayLimit = 5;
    protected $labelClass = 'checkbox-label';
    protected $capitaliseTerm = false;

    public function displayFacet()
    {
        $this->initialiseFacet();
        $this->checkLimits();

        foreach ($this->resultSet as $documentKey => $document) {
            if ($this->i >= $this->resultLimit) {
                break;
            }

            $resultWordCollection = explode(' ', mb_strtolower($this->documentCollection->getDocumentElement($documentKey, $this->relatedTermsSource)));
            $frequencyOfWords = array_count_values($resultWordCollection);
            foreach ($frequencyOfWords as $key => $value) {
                $this->relatedTerms[$key] += $value;
            }

            $this->i++;
        }

        $this->removeUnwantedCharacters();
        $this->removeCurrentQueries();
        $this->sortRelatedTerms();
        $this->relatedTerms = array_filter($this->relatedTerms);
        $this->relatedTerms = array_combine(array_keys($this->relatedTerms), array_keys($this->relatedTerms));
        $this->relatedTerms = array_filter($this->relatedTerms);

        if ($this->capitaliseTerm === true) {
            $this->capitaliseTerms();
        }

        echo $this->generateList();
    }

    private function checkLimits()
    {
        if ($this->resultLimit <= 0) {
            $this->resultLimit = 10;
        }
        if ($this->displayLimit <= 0) {
            $this->displayLimit = 5;
        }
    }

    private function removeUnwantedCharacters()
    {
        foreach ($this->relatedTerms as $term => $value) {
            $cleanedTerm = preg_replace('/[^\p{L&}\p{Nd}\p{Pd}\s]+/ui', '', $term);
            $cleanedTerm = preg_replace($this->stopWords, '', $cleanedTerm);
            $cleanedTerms[$cleanedTerm] = $value;
        }

        $this->relatedTerms = $cleanedTerms;
    }

    private function removeCurrentQueries()
    {
        if ($this->queryHandler->isQuerySet($this->elementToSearchBy)) {
            foreach ($this->queryHandler->getQueryValue($this->elementToSearchBy) as $currentQuery) {
                $this->relatedTerms[$currentQuery] = null;
            }
        }
    }

    private function sortRelatedTerms()
    {
        arsort($this->relatedTerms, SORT_NUMERIC);
    }

    private function capitaliseTerms()
    {
        foreach ($this->relatedTerms as &$term) {
            $term = ucfirst($term);
        }
    }

    private function generateList()
    {
        $this->i = 0;
        $output = '';
        foreach ($this->relatedTerms as $term) {
            if ($this->i >= $this->displayLimit) {
                break;
            }

            if (empty($this->labelClass)) {
                $class = '';
            } else {
                $class = 'class="'.$this->labelClass.'"';
            }

            $output .= '<label for="'.$term.'" '.$class.'>'.$term.'<input style="float:left;" id="'.$term.'" type="checkbox" value="'.$term.'" data-cookie="T4_persona"  name="'.$this->elementToSearchBy.'"></label>';
            $this->i++;
        }
        return $output;
    }
}
                
                

/* FacetFactory.php 
namespace T4\PHPSearchLibrary;

use T4\PHPSearchLibrary\FacetFactory\ListFacet;
use T4\PHPSearchLibrary\FacetFactory\RelatedTermsFacet;
use T4\PHPSearchLibrary\FacetFactory\DropdownFacet;
use T4\PHPSearchLibrary\FacetFactory\RangeFacet;
use T4\PHPSearchLibrary\FacetFactory\DateFacet;
use T4\PHPSearchLibrary\FacetFactory\AtoZFacet;

use \RuntimeException;
use \InvalidArgumentException;
use \LengthException;
use \OutOfBoundsException;
use \UnderflowException;
 */

class FacetFactory
{
    public static function getInstance($facet, $documentCollection, $queryHandler)
    {
        $documents = $documentCollection->getDocuments();
        if(empty($documents)) {
            throw new UnderflowException("Result set is empty");
        }
        switch ($facet) {
            case 'ListFacet':
                return new ListFacet($documentCollection, $queryHandler);
                break;
            
            case 'RelatedTermsFacet':
                return new RelatedTermsFacet($documentCollection, $queryHandler);
                break;

            case 'DropdownFacet':
                return new DropdownFacet($documentCollection, $queryHandler);
                break;

            case 'RangeFacet':
                return new RangeFacet($documentCollection, $queryHandler);
                break;

            case 'DateFacet':
                return new DateFacet($documentCollection, $queryHandler);
                break;

            case 'AtoZFacet':
                return new AtoZFacet($documentCollection, $queryHandler);
                break;

            default:
                throw new RuntimeException('No instance of '.$facet.' could be created');
                break;
        }
    }
}
                
                

/* Filter.php 
namespace T4\PHPSearchLibrary\FilterFactory\Abstracts;

use T4\PHPSearchLibrary\SearchFactory\Search;

use \RuntimeException;
use \InvalidArgumentException;
use \LengthException;
use \OutOfBoundsException;
use \UnderflowException;
 */

abstract class Filter
{
    protected $search;
    protected $documents;
    protected $query;
    protected $element;
    protected $combinationOption = false;
    protected $temporaryDocumentResults = array();

    public function __construct(Search $search)
    {
        $this->search = $search;
    }

    protected function initialiseFilter()
    {
        $this->documents = $this->search->getDocuments();

        if (!is_array($this->query)) {
            throw new InvalidArgumentException('$query must be of type array');
        }
    }

    protected function storePartialDocumentResults()
    {
        if ($this->combinationOption === true) {
            $this->search->storeCombinedDocumentResults($this->temporaryDocumentResults);
        } else {
            $this->search->storePartialDocumentResults($this->temporaryDocumentResults);
        }

        $this->emptyTemporaryDocumentResults();
    }

    private function emptyTemporaryDocumentResults()
    {
        $this->temporaryDocumentResults = array();
    }

    public function setMember($name, $value)
    {
        $this->$name = $value;
    }

    abstract public function runFilter();
}
                
                

/* FilterByDate.php 
namespace T4\PHPSearchLibrary\FilterFactory;

use T4\PHPSearchLibrary\FilterFactory\Abstracts\Filter;

use \DateTime;

use \RuntimeException;
use \InvalidArgumentException;
use \LengthException;
use \OutOfBoundsException;
use \UnderflowException;
 */

class FilterByDate extends Filter
{
    protected $dates;
    protected $format = 'Y-m-d';
    protected $limit = 'maximum';
    protected $type = 'after';

    public function runFilter()
    {
        $this->initialiseFilter();

        $this->date = $this->query[0];
        $this->validateDate();

        if(!in_array($this->type,array("before","after"))) {
            $this->type = "after";
        }

        foreach ($this->documents as $documentKey => $document) {
            if ($this->documentIsWithinDate($document)) {
                $this->temporaryDocumentResults[$documentKey] = $documentKey;
            }
        }

        $this->storePartialDocumentResults();

        return true;
    }

    private function validateDate()
    {
        if (count($this->query) > 1) {
            throw new LengthException("There must be no more than one query given when searching by date");
        }

        $d = DateTime::createFromFormat($this->format, $this->date);
        if (!($d && $d->format($this->format) == $this->date)) {
            throw new InvalidArgumentException("Date values must be a valid date, value: <em>".$this->date."</em> is not a date");
        }
        
    }

    private function documentIsWithinDate($document)
    {
        $documentDate = DateTime::createFromFormat($this->format, $document[$this->element]);
        $comparingDate = DateTime::createFromFormat($this->format, $this->date);
        //Ignore no date element.
        if ($documentDate && $documentDate->format($this->format) == $document[$this->element]) {
            switch ($this->type) {
            case "before":
                $comparingDate->setTime(23,59,59); 
                if ($documentDate <= $comparingDate) {
                    return true;
                } else {
                    return false;
                }
                break;
            default:
                $comparingDate->setTime(0,0,0); 
                if ($documentDate >= $comparingDate) {
                    return true;
                } else {
                    return false;
                }
                break;
            }
        } else {
            return false;
        }
    }
}
                
                

/* FilterByExactMatch.php 
namespace T4\PHPSearchLibrary\FilterFactory;

use T4\PHPSearchLibrary\FilterFactory\Abstracts\Filter;

use \RuntimeException;
use \InvalidArgumentException;
use \LengthException;
use \OutOfBoundsException;
use \UnderflowException;
 */

class FilterByExactMatch extends Filter
{
    public function runFilter()
    {
        $this->initialiseFilter();

        foreach ($this->documents as $documentKey => $document) {
            $documentElement = mb_strtolower($document[$this->element]);

            $documentElementArray = array();
            if (isset($this->multipleValueState) && $this->multipleValueState === true) {
                if (mb_strpos($documentElement, $this->multipleValueSeparator) !== false) {
                    $documentElementArray = explode($this->multipleValueSeparator,$documentElement);
                }
            }
            foreach ($this->query as $query) {
                if(!empty($documentElementArray) && in_array($query, $documentElementArray)) {
                    $this->temporaryDocumentResults[$documentKey] = $documentKey;
                } elseif ($documentElement === $query) {
                    $this->temporaryDocumentResults[$documentKey] = $documentKey;
                }
            }
        }

        $this->storePartialDocumentResults();

        return true;
    }
}
                
                

/* FilterByLetterComparison.php 
namespace T4\PHPSearchLibrary\FilterFactory;

use T4\PHPSearchLibrary\FilterFactory\Abstracts\Filter;

use \RuntimeException;
use \InvalidArgumentException;
use \LengthException;
use \OutOfBoundsException;
use \UnderflowException;
 */

class FilterByLetterComparison extends Filter
{
    protected $startPosition = 0;
    protected $endPosition = 1;

    public function runFilter()
    {
        $this->initialiseFilter();
        $this->validate();

        foreach ($this->documents as $documentKey => $document) {
            $documentElement = mb_strtolower($document[$this->element]);
            foreach ($this->query as $query) {
                if (mb_substr($documentElement, $this->startPosition, $this->endPosition) === $query) {
                    $this->temporaryDocumentResults[$documentKey] = $documentKey;
                }
            }
        }

        $this->storePartialDocumentResults();
        
        return true;
    }

    private function validate()
    {
        if (!is_int($this->startPosition) || !is_int($this->endPosition)) {
            throw new InvalidArgumentException('start and end positions must be of type integer');
        }
    }
}

                
                

/* FilterByRange.php 
namespace T4\PHPSearchLibrary\FilterFactory;

use T4\PHPSearchLibrary\FilterFactory\Abstracts\Filter;

use \RuntimeException;
use \InvalidArgumentException;
use \LengthException;
use \OutOfBoundsException;
use \UnderflowException;
 */

class FilterByRange extends Filter
{
    protected $range;
    protected $limit = 'maximum';

    public function runFilter()
    {
        $this->initialiseFilter();
        $this->range = explode('-', $this->query[0]);
        $this->validateRange();

        foreach ($this->documents as $documentKey => $document) {
            if ($this->documentIsWithinRange($document)) {
                $this->temporaryDocumentResults[$documentKey] = $documentKey;
            }
        }

        $this->storePartialDocumentResults();

        return true;
    }

    private function validateRange()
    {
        if (count($this->query) > 1) {
            throw new LengthException("There must be no more than one query given when searching by range");
        }
        foreach ($this->range as $index => $range) {
            if (empty($range)) {
                $this->range[$index] = 0;
            }
            if (!is_numeric($this->range[$index])) {
                throw new InvalidArgumentException("Range values must be numeric, value: <em>".$range."</em> is not numeric");
            }
        }
    }

    private function documentIsWithinRange($document)
    {
        $documentCost = str_replace(array('$', '£', '€', ',', '.'), '', $document[$this->element]);
        switch (count($this->range)) {
            case 1:
                if ($this->limit === 'maximum') {
                    if ($this->range[0] >= $documentCost) {
                        return true;
                    } else {
                        return false;
                    }
                } else {
                    if ($this->range[0] <= $documentCost) {
                        return true;
                    } else {
                        return false;
                    }
                }
                break;

            case 2:
                if ($this->range[0] <= $documentCost && $this->range[1] >= $documentCost) {
                    return true;
                } else {
                    return false;
                }
                break;
            
            default:
                return false;
                break;
        }
    }
}
                
                

/* FilterBySubstring.php 
namespace T4\PHPSearchLibrary\FilterFactory;

use T4\PHPSearchLibrary\FilterFactory\Abstracts\Filter;

use \RuntimeException;
use \InvalidArgumentException;
use \LengthException;
use \OutOfBoundsException;
use \UnderflowException;
 */

class FilterBySubstring extends Filter
{
    public function runFilter()
    {
        $this->initialiseFilter();

        foreach ($this->documents as $documentKey => $document) {
            $documentElement = mb_strtolower($document[$this->element]);
            foreach ($this->query as $query) {
                if (mb_strpos($documentElement, $query) !== false) {
                    $this->temporaryDocumentResults[$documentKey] = $documentKey;
                    break;
                }
            }
        }

        $this->storePartialDocumentResults();

        return true;
    }
}
                
                

/* FilterByWord.php 
namespace T4\PHPSearchLibrary\FilterFactory;

use T4\PHPSearchLibrary\FilterFactory\Abstracts\Filter;

use \RuntimeException;
use \InvalidArgumentException;
use \LengthException;
use \OutOfBoundsException;
use \UnderflowException;
 */

class FilterByWord extends Filter
{
    public function runFilter()
    {
        $this->initialiseFilter();

        foreach ($this->documents as $documentKey => $document) {
            foreach ($this->query as $query) {
                if (preg_match('/\b'.$query.'\b/ui', $document[$this->element])) {
                    $this->temporaryDocumentResults[$documentKey] = $documentKey;
                }
            }
        }

        $this->storePartialDocumentResults();
        
        return true;
    }
}
                
                

/* FilterFactory.php 
namespace T4\PHPSearchLibrary;

use T4\PHPSearchLibrary\FilterFactory\FilterBySubstring;
use T4\PHPSearchLibrary\FilterFactory\FilterByWord;
use T4\PHPSearchLibrary\FilterFactory\FilterByExactMatch;
use T4\PHPSearchLibrary\FilterFactory\FilterByLetterComparison;
use T4\PHPSearchLibrary\FilterFactory\FilterByRange;
use T4\PHPSearchLibrary\FilterFactory\FilterByDate;

use \RuntimeException;
use \InvalidArgumentException;
use \LengthException;
use \OutOfBoundsException;
use \UnderflowException;
 */

class FilterFactory
{
    public static function getInstance($filter, $search)
    {
        switch ($filter) {
            case 'FilterBySubstring':
                return new FilterBySubstring($search);
                break;
            
            case 'FilterByWord':
                return new FilterByWord($search);
                break;

            case 'FilterByExactMatch':
                return new FilterByExactMatch($search);
                break;

            case 'FilterByLetterComparison':
                return new FilterByLetterComparison($search);
                break;

            case 'FilterByRange':
                return new FilterByRange($search);
                break;

            case 'FilterByDate':
                return new FilterByDate($search);
                break;

            default:
                throw new RuntimeException('No instance of '.$filter.' could be created');
                break;
        }
    }
}
                
                

/* Pagination.php 
namespace T4\PHPSearchLibrary\PaginationFactory;

use T4\PHPSearchLibrary\DocumentCollectionFactory\DocumentCollection;
use T4\PHPSearchLibrary\QueryHandlerFactory\QueryHandler;
use T4\PHPSearchLibrary\QueryFormatterFactory;

use \RuntimeException;
use \InvalidArgumentException;
use \LengthException;
use \OutOfBoundsException;
use \UnderflowException;
 */

class Pagination
{
    private $documentCollection;
    private $queryHandler;
    private $previousLinkText = '‹';
    private $nextLinkText = '›';
    private $firstLinkText = '«';
    private $lastLinkText = '»';
    private $numberOfDocumentsToDisplay = 10;
    private $pageNumber = 1;
    private $totalNumberOfDocuments;
    private $documentStartingPosition = 1;
    private $totalNumberOfPages = 1;
    private $ellipsisGap = 2;
    private $nextLinkState = false;
    private $prevLinkState = false;
    private $paginationState = false;
    private $currentPageClass = 'active';
    private $currentPage = '';
    private $ellipsisClass = 'disabled';
    private $ulClass = '';
    private $ulId = '';
    private $nextLinkClass = null;
    private $prevLinkClass = null;
    private $pageNearBeginning = false;
    private $pageNearEnd = false;
    private $currentQueryURLString;

    public function __construct(DocumentCollection $documentCollection, QueryHandler $queryHandler, $documentsToDisplay)
    {
        $this->documentCollection = $documentCollection;
        $this->queryHandler = $queryHandler;
        if (!is_null($documentsToDisplay) && is_integer($documentsToDisplay)) {
            $this->numberOfDocumentsToDisplay = $documentsToDisplay;
        }

        if ($this->queryHandler->isQuerySet('paginate')) {
            $this->setNumberOfDocumentsToDisplay();
        }
        if ($this->queryHandler->isQuerySet('page')) {
            $this->setPageNumber();
        }

        $this->setCurrentQueryURLString();

        $this->setDocumentStartingPosition();
        $this->setTotalNumberOfDocuments();
        $this->setPaginatedDocumentResults();
        $this->setTotalNumberOfPages();

        $this->setPaginationState();
        $this->setPrevLinkState();
        $this->setNextLinkState();

        $this->documentCollection->setPaginationState($this->paginationState);
    }

    private function setNumberOfDocumentsToDisplay()
    {
        $this->numberOfDocumentsToDisplay = $this->queryHandler->getQueryValue('paginate');
        $this->numberOfDocumentsToDisplay = abs((int) $this->numberOfDocumentsToDisplay[0]);
    }

    private function setPageNumber()
    {
        $this->pageNumber = $this->queryHandler->getQueryValue('page');
        $this->pageNumber = abs((int) $this->pageNumber[0]);
    }

    private function setCurrentQueryURLString()
    {
        $formatQueryAsArray = QueryFormatterFactory::getInstance('FormatQueryAsArray', $this->queryHandler);
        $formatQueryAsArray->setMember('excludedQueries', array('page'));
        $this->currentQueryURLString = $formatQueryAsArray->format();
    }

    private function setDocumentStartingPosition()
    {
        $this->documentStartingPosition = ($this->pageNumber - 1) * $this->numberOfDocumentsToDisplay;
    }

    private function setTotalNumberOfDocuments()
    {
        $this->totalNumberOfDocuments = count($this->documentCollection->getDocumentResults());
    }

    private function setPaginatedDocumentResults()
    {
        $this->documentCollection->setPaginatedDocumentResults($this->documentCollection->sliceDocumentResults($this->documentStartingPosition, $this->numberOfDocumentsToDisplay));
    }

    private function setTotalNumberOfPages()
    {
        $this->totalNumberOfPages = (int) ceil($this->totalNumberOfDocuments / $this->numberOfDocumentsToDisplay);
    }

    private function setPaginationState()
    {
        if ($this->documentStartingPosition < $this->totalNumberOfDocuments && $this->pageNumber > 0 && $this->totalNumberOfDocuments > $this->numberOfDocumentsToDisplay) {
            $this->paginationState = true;
        }
        if ($this->documentCollection->wereResultsFound() === false && $this->queryHandler->doQuerysExist() === true) {
            $this->paginationState = false;
        }
    }

    private function setPrevLinkState()
    {
        if ($this->documentStartingPosition !== 0) {
            $this->prevLinkState = true;
        }
    }

    private function setNextLinkState()
    {
        if ($this->documentStartingPosition + $this->numberOfDocumentsToDisplay < $this->totalNumberOfDocuments) {
            $this->nextLinkState = true;
        }
    }

    public function displayNavigation($echo_by_default = true, $array = false)
    {
        if ($this->paginationIsRequired()) {
            $this->setPageNearBeginningState();
            $this->setPageNearEndState();

            $pagLinks = array();

            if (empty($this->ulClass)) {
                $class = '';
            } else {
                $class = 'class="'.$this->ulClass.'"';
            }

            if (empty($this->ulId)) {
                $id = '';
            } else {
                $id = 'id="'.$this->ulId.'"';
            }

            $pagination = '<ul '.$id.' '.$class.'>';

            if ($this->prevLinkIsRequired()) {
                $pagination .= $this->outputFirstPage($this->firstLinkText);
                $pagLinks = array_merge($pagLinks, $this->outputFirstPage($this->firstLinkText, false, true));
                $pagination .= $this->outputPreviousLink($this->pageNumber - 1);
                $pagLinks = array_merge($pagLinks, $this->outputPreviousLink($this->pageNumber - 1, false, true));
            }

            $pagination .= $this->outputFirstPage();
            $pagLinks = array_merge($pagLinks, $this->outputFirstPage('1', false, true));

            if ($this->ellipsisRequired('beginning')) {
                $pagination .= $this->outputEllipsis();
                $pagLinks = array_merge($pagLinks, $this->outputEllipsis(false, true));
            }

            $pagination .= $this->outputPaginationRange();
            $pagLinks = array_merge($pagLinks, $this->outputPaginationRange(false, true));

            if ($this->ellipsisRequired('end')) {
                $pagination .= $this->outputEllipsis();
                $pagLinks = array_merge($pagLinks, $this->outputEllipsis(false, true));
            }

            $pagination .= $this->outputLastPage();
            $pagLinks = array_merge($pagLinks, $this->outputLastPage(null, false, true));

            if ($this->nextLinkIsRequired()) {
                $pagination .= $this->outputNextLink($this->pageNumber + 1);
                $pagLinks = array_merge($pagLinks, $this->outputNextLink($this->pageNumber + 1, false, true));
                $pagination .= $this->outputLastPage($this->lastLinkText);
                $pagLinks = array_merge($pagLinks, $this->outputLastPage($this->lastLinkText, false, true));
            }

            $pagination .= '</ul>';

            if ($echo_by_default === true) {
                echo $pagination;
            } else {
                if ($array === true) {
                    return $pagLinks;
                }

                return $pagination;
            }
        }
    }

    private function paginationIsRequired()
    {
        return $this->paginationState;
    }

    private function setPageNearBeginningState()
    {
        if (($this->pageNumber - ($this->ellipsisGap + 1)) < 2) {
            $this->pageNearBeginning = true;
        }
    }

    private function setPageNearEndState()
    {
        if (($this->totalNumberOfPages - $this->pageNumber) < $this->ellipsisGap + 2) {
            $this->pageNearEnd = true;
        }
    }

    private function prevLinkIsRequired()
    {
        return $this->prevLinkState;
    }

    private function outputPreviousLink($pageNumber, $list = true, $array = false)
    {

        $type = "prev";

        if (!is_null($this->prevLinkClass)) {
            $class = $type.' '.$this->prevLinkClass.'';
        } else {
            $class = $type;
        }

        $output = '';

        if ($list == true) {
            $output .= '<li class="'.$class.'">';
        }

        $query_array = $this->currentQueryURLString;

        if($pageNumber != 1) {
            $query_array['page'] = $pageNumber; 
        }

        $href  = $this->currentPage;

        $buildQuery = $this->buildURLfromQuery($query_array);

        $href .= !empty($buildQuery) ? '?'.$buildQuery : '';

        $output .= '<a href="'.$href.'" class="pbc-pag-prev">'.$this->previousLinkText.'</a>';
        $outputArray[] = array(
            'href' => $href, 
            'text' => $this->previousLinkText, 
            'class' => $class, 
            'type' => $type, 
            'current' => false);

        if ($list == true) {
            $output .= '</li>';
        }
        if ($array == true) {
            return $outputArray;
        }

        return $output;
    }

    private function outputFirstPage($text = '1', $list = true, $array = false)
    {
        $type = "first-page";

        if ($this->pageNumber === 1) {
            $class = $type.' '.$this->currentPageClass.'';
            $current = true;
        } else {
            $class = $type;
            $current = false;
        }

        $output = '';

        if ($list == true) {
            $output .= '<li class="'.$class.'">';
        }


        $query_array = $this->currentQueryURLString;

        $href  = $this->currentPage;

        $buildQuery = $this->buildURLfromQuery($query_array);

        $href .= !empty($buildQuery) ? '?'.$buildQuery : '';

        $output .= '<a href="'.$href.'" class="pbc-pag-first">'.$text.'</a>';
        $outputArray[] = array(
            'href' => $href, 
            'text' => $text, 
            'class' => $class, 
            'type' => $type, 
            'current' => $current);

        if ($list == true) {
            $output .= '</li>';
        }
        if ($array == true) {
            return $outputArray;
        }

        return $output;
    }

    private function ellipsisRequired($position)
    {
        if ($position === 'beginning') {
            if (($this->pageNearBeginning === false && $this->pageNearEnd === false) || ($this->pageNearEnd === true && $this->pageNearBeginning === false)) {
                return true;
            }
        } elseif ($position === 'end') {
            if (($this->pageNearBeginning === false && $this->pageNearEnd === false) || ($this->pageNearEnd === false && $this->pageNearBeginning === true)) {
                return true;
            }
        }
    }

    private function outputEllipsis($list = true, $array = false)
    {
         $output = '';
         
        if (empty($this->ellipsisClass)) {
            $class = '';
        } else {
            $class = ''.$this->ellipsisClass.'';
        }
        if ($list == true) {
            $output .= '<li class="'.$class.'">';
        }
        $output .= '<a>…</a>';

        $outputArray[] = array(
            'href' => '', 
            'text' => '…',
            'class' => $class, 
            'type' => 'ellipsis', 
            'current' => false
            );

        if ($list == true) {
            $output .= '</li>';
        }

        if ($array == true) {
            return $outputArray;
        }

        return $output;
    }

    private function buildURLfromQuery($query) 
    {

        $walk = function( $item, $key, $parent_key = '' ) use ( &$output, &$walk ) {
                is_array( $item ) 
                    ? array_walk( $item, $walk, $key ) 
                    : $output[] = http_build_query( array( $parent_key ?: $key => $item ) );

            };

        array_walk( $query, $walk );
        
        if(is_array($output)) {
            return implode( '&', $output );
        } else {
            return '';
        }
    }

    private function outputPaginationRange($list = true, $array = false)
    {
        $output = '';
        $class = '';
        $outputArray = array();


        for ($i = $this->pageNumber - $this->ellipsisGap; $i <= $this->pageNumber + $this->ellipsisGap; ++$i) {
            if ($i > 1 && $i < $this->totalNumberOfPages) {
                $type = 'page-'.$i;
                $page ='';
                if ($i === $this->pageNumber) {
                    $class = $type.' '.$this->currentPageClass.'';
                    $current = true;
                } else {
                    $class = $type;
                    $current = false;
                }

                if ($list == true) {
                    $output .= '<li class="'.$class.'">';
                }

                $query_array = $this->currentQueryURLString;

                if($i != 1) {
                    $query_array['page'] = $i; 
                }


                $href  = $this->currentPage;

                $buildQuery = $this->buildURLfromQuery($query_array);

                $href .= !empty($buildQuery) ? '?'.$buildQuery : '';

                $output .= '<a href="'.$href.'" class="pbc-pag-num">'.$i.'</a>';
                $outputArray[] = array(
                    'href' => $href, 
                    'text' => $i, 
                    'class' => $class, 
                    'type' => $type, 
                    'current' => $current
                );

                if ($list == true) {
                    $output .= '</li>';
                }
            }
        }
        if ($array == true) {
            return $outputArray;
        }

        return $output;
    }

    private function outputLastPage($text = null, $list = true, $array = false)
    {
        $type = 'last-page';
        if ($this->pageNumber === $this->totalNumberOfPages) {
            $class = $type.' '.$this->currentPageClass.'';
            $current = true;
        } else {
            $class = $type;
            $current = false;
        }

        $output = '';

        if ($list == true) {
            $output .= '<li class="'.$class.'">';
        }

        $query_array = $this->currentQueryURLString;

        $query_array['page'] = $this->totalNumberOfPages; 

        $href  = $this->currentPage;

        $buildQuery = $this->buildURLfromQuery($query_array);

        $href .= !empty($buildQuery) ? '?'.$buildQuery : '';

        $text = !empty($text) ? $text : $this->totalNumberOfPages;

        $output .= '<a href="'.$href.'" class="pbc-pag-last">'.$text.'</a>';
        $outputArray[] = array(
            'href' => $href, 
            'text' => $text, 
            'class' => $class, 
            'type' => $type, 
            'current' => $current
        );

        if ($list == true) {
            $output .= '</li>';
        }
        if ($array == true) {
            return $outputArray;
        }

        return $output;
    }

    private function nextLinkIsRequired()
    {
        return $this->nextLinkState;
    }

    private function outputNextLink($pageNumber, $list = true, $array = false)
    {
        $type = 'next';
        if (!is_null($this->nextLinkClass)) {
            $class = $type.' '.$this->nextLinkClass.'';
        } else {
            $class = $type;
        }

        $output = '';

        if ($list == true) {
            $output .= '<li class="'.$class.'">';
        }

        $query_array = $this->currentQueryURLString;

        $query_array['page'] = $pageNumber; 

        $href  = $this->currentPage;

        $buildQuery = $this->buildURLfromQuery($query_array);

        $href .= !empty($buildQuery) ? '?'.$buildQuery : '';

        $output .= '<a href="'.$href.'" class="pbc-pag-next">'.$this->nextLinkText.'</a>';
        $outputArray[] = array(
            'href' => $href, 
            'text' => $this->nextLinkText, 
            'class' => $class, 
            'type' => $type, 
            'current' => false
        );

        if ($list == true) {
            $output .= '</li>';
        }
        if ($array == true) {
            return $outputArray;
        }

        return $output;
    }

    // private function isPageNearBeginning()
    // {
    //     return $this->pageNearBeginning;
    // }

    // private function isPageNearEnd()
    // {
    //     return $this->pageNearEnd;
    // }

    public function setMember($name, $value)
    {
        $this->$name = $value;
    }

    public function getPage($type){
        $printPagination = $this->displayNavigation(false,true);
        $pageId = false;

        if($printPagination !== null) {
            if ($type == "current") {
                $pageId = array_search(true, array_column($printPagination, 'current'));
            } else {
                $pageId = array_search($type, array_column($printPagination, 'type'));
            }
        }
        if($pageId === false) {
            return null;
        }

        return $printPagination[$pageId];
    }
}
                
                

/* PaginationFactory.php 
namespace T4\PHPSearchLibrary;

use T4\PHPSearchLibrary\PaginationFactory\Pagination;

use \RuntimeException;
use \InvalidArgumentException;
use \LengthException;
use \OutOfBoundsException;
use \UnderflowException;
 */

class PaginationFactory
{
    public static function getInstance($pagination, $documentCollection, $queryHandler, $documentsToDisplay = null)
    {
        switch ($pagination) {
            case 'Pagination':
                return new Pagination($documentCollection, $queryHandler, $documentsToDisplay);
                break;

            default:
                throw new RuntimeException('No instance of '.$pagination.' could be created');
                break;
        }
    }
}
                
                

/* Processor.php 
namespace T4\PHPSearchLibrary\ProcessorFactory\Abstracts;

use T4\PHPSearchLibrary\DocumentCollectionFactory\DocumentCollection;

use \RuntimeException;
use \InvalidArgumentException;
use \LengthException;
use \OutOfBoundsException;
use \UnderflowException;
 */

abstract class Processor
{
    protected $documentCollection;
    protected $element;
    protected $query;
    protected $boost = 1;
    protected $temporaryRankedDocuments = array();
    protected $totalNumberOfDocumentsInCollection;
    protected $numberOfDocumentResults;

    public function __construct(DocumentCollection $documentCollection)
    {
        $this->documentCollection = $documentCollection;
    }

    protected function initialiseProcessor()
    {
        $this->totalNumberOfDocumentsInCollection = $this->documentCollection->getTotalNumberOfDocumentsInCollection();
        $this->numberOfDocumentResults = $this->documentCollection->getNumberOfDocumentResults();

        if ($this->boost <= 0 || !is_numeric($this->boost)) {
            $this->boost = 1;
        }

        if (!is_array($this->query)) {
            throw new InvalidArgumentException('$query must be of type array');
        }
    }

    protected function storePartialRankedDocuments()
    {
        $this->documentCollection->storePartialRankedDocuments($this->temporaryRankedDocuments);

        $this->emptyTemporaryRankedDocuments();
    }

    private function emptyTemporaryRankedDocuments()
    {
        $this->temporaryRankedDocuments = null;
    }

    public function setMember($name, $value)
    {
        $this->$name = $value;
    }

    abstract public function runProcessor();
}
                
                

/* CompoundSearch.php 
namespace T4\PHPSearchLibrary\ProcessorFactory;

use T4\PHPSearchLibrary\ProcessorFactory\Abstracts\Processor;

use \RuntimeException;
use \InvalidArgumentException;
use \LengthException;
use \OutOfBoundsException;
use \UnderflowException;
 */

class CompoundSearch extends Processor
{
    private $queryIncrement = 1;
    protected $queryIncrementLimit = 10;
    protected $elementScore = 1;

    public function runProcessor()
    {
        $this->initialiseProcessor();
    
        foreach ($this->documentCollection->getDocumentResults() as $documentKey => $documentValue) {
            $this->queryIncrement = 1;
            $elementWordCollection = mb_strtolower($this->documentCollection->getDocumentElement($documentKey, $this->element));

            foreach ($this->query as $query) {
                if ($this->queryIncrement <= $this->queryIncrementLimit) {
                    if (mb_strpos($elementWordCollection, $query) !== false) {
                        if(!isset($this->temporaryRankedDocuments[$documentKey])) {
                            $this->temporaryRankedDocuments[$documentKey] = 0;
                        }
                        $this->temporaryRankedDocuments[$documentKey] += ($this->boost * $this->elementScore);
                    }
                }
                $this->queryIncrement++;
            }
        }

        $this->storePartialRankedDocuments();
    }
}
                
                

/* FrequencySearch.php 
namespace T4\PHPSearchLibrary\ProcessorFactory;

use T4\PHPSearchLibrary\ProcessorFactory\Abstracts\Processor;

use \RuntimeException;
use \InvalidArgumentException;
use \LengthException;
use \OutOfBoundsException;
use \UnderflowException;
 */

class FrequencySearch extends Processor
{
    public function runProcessor()
    {
        $this->initialiseProcessor();

        foreach ($this->documentCollection->getDocumentResults() as $documentKey => $documentValue) {

            $resultWordCollection = explode(' ', mb_strtolower($this->documentCollection->getDocumentElement($documentKey, $this->element)));
            $totalWordsInDocument = count($resultWordCollection);
            $frequencyOfWords = array_count_values($resultWordCollection);
            $queryInDocumentCount = array();



            foreach ($frequencyOfWords as $frequencyKey => $frequencyValue) {
                foreach ($this->query as $query) {
                    if (mb_strpos($frequencyKey, $query) !== false) {
                        if(!isset($queryInDocumentCount[$query])) {
                            $queryInDocumentCount[$query] = 0;
                        }
                        $queryInDocumentCount[$query] += $frequencyValue;
                    }
                }
            }

            if (!empty($queryInDocumentCount)) {
                foreach ($queryInDocumentCount as $key => $value) {
                    if(!isset($this->temporaryRankedDocuments[$documentKey])) {
                        $this->temporaryRankedDocuments[$documentKey] = 0;
                    }
                    $this->temporaryRankedDocuments[$documentKey] += ($this->boost * $this->calculateBM25($value, $totalWordsInDocument));
                }
            } else {
                if(!isset($this->temporaryRankedDocuments[$documentKey])) {
                    $this->temporaryRankedDocuments[$documentKey] = 0;
                }
                $this->temporaryRankedDocuments[$documentKey] += 0;
            }
        }

        $this->storePartialRankedDocuments();
    }

    private function calculateBM25($termFrequency, $totalWordsInDocument)
    {
        return ($termFrequency * (1.2 + 1)) / ($termFrequency + (1.2 * (1 - 0.75 + (0.75 * ($totalWordsInDocument / 20)))));
    }
}
                
                

/* ProximitySearch.php 
namespace T4\PHPSearchLibrary\ProcessorFactory;

use T4\PHPSearchLibrary\ProcessorFactory\Abstracts\Processor;

use \RuntimeException;
use \InvalidArgumentException;
use \LengthException;
use \OutOfBoundsException;
use \UnderflowException;
 */

class ProximitySearch extends Processor
{
    private $documentDistance = 0;

    public function runProcessor()
    {
        $this->initialiseProcessor();

        if (count($this->query) >= 2) {
            foreach ($this->documentCollection->getDocumentResults() as $documentKey => $document) {
                $this->documentDistance = 0;
                $elementWords = str_word_count(mb_strtolower($this->documentCollection->getDocumentElement($documentKey, $this->element)), 1);
                $queryPositions = array_intersect($elementWords, $this->query);

                if (empty($queryPositions)) {
                    continue;
                }

                foreach ($queryPositions as $currentQueryPosition => $currentQuery) {
                    $distance = array();
                    foreach ($queryPositions as $nextQueryPosition => $nextQuery) {
                        if ($currentQuery !== $nextQuery) {
                            $distance[] = abs($nextQueryPosition - $currentQueryPosition);
                        }
                    }
                    if (!empty($distance)) {
                        sort($distance, SORT_NUMERIC);
                        $this->documentDistance += (1 / ++$distance[0]);
                    }
                }
                if(!isset($this->temporaryRankedDocuments[$documentKey])) {
                    $this->temporaryRankedDocuments[$documentKey] = 0;
                }
                $this->temporaryRankedDocuments[$documentKey] += ($this->boost * $this->documentDistance);
            }
        }

        $this->storePartialRankedDocuments();
    }
}
                
                

/* QueryVolumeSearch.php 
namespace T4\PHPSearchLibrary\ProcessorFactory;

use T4\PHPSearchLibrary\ProcessorFactory\Abstracts\Processor;

use \RuntimeException;
use \InvalidArgumentException;
use \LengthException;
use \OutOfBoundsException;
use \UnderflowException;
 */

class QueryVolumeSearch extends Processor
{
    private $documentScore = 0;

    public function runProcessor()
    {
        $this->initialiseProcessor();


        foreach ($this->documentCollection->getDocumentResults() as $documentKey => $document) {
            $this->documentScore = 0;
            $elementContents = mb_strtolower($this->documentCollection->getDocumentElement($documentKey, $this->element));
            $elementLength = mb_strlen($elementContents);
            foreach ($this->query as $query) {
                if (mb_strpos($elementContents, $query) !== false) {

                    $queryLength = mb_strlen($query);
                    $this->documentScore += ($queryLength / $elementLength);
                }
            }
            if(!isset($this->temporaryRankedDocuments[$documentKey])) {
                $this->temporaryRankedDocuments[$documentKey] = 0;
            }
            $this->temporaryRankedDocuments[$documentKey] += ($this->boost * $this->documentScore);
        }

        $this->storePartialRankedDocuments();
    }
}
                
                

/* RadialPatternSearch.php 
namespace T4\PHPSearchLibrary\ProcessorFactory;

use T4\PHPSearchLibrary\ProcessorFactory\Abstracts\Processor;

use \RuntimeException;
use \InvalidArgumentException;
use \LengthException;
use \OutOfBoundsException;
use \UnderflowException;
 */

class RadialPatternSearch extends Processor
{
    const DEFAULTVALUELIMIT = 10;
    private $documentScore = 0;
    protected $query = array();
    protected $radialItems = array();
    protected $multipleValueSeparator;
    protected $multipleValueState = false;
    protected $valueLimit = self::DEFAULTVALUELIMIT;

    public function runProcessor()
    {
        $this->initialiseProcessor();

        foreach ($this->documentCollection->getDocumentResults() as $documentKey => $document) {
            $processorValues[] = mb_strtolower($this->documentCollection->getDocumentElement($documentKey, $this->element));
        }

        if ($this->multipleValueState) {
            foreach ($processorValues as $value) {
                if (mb_strpos($value, $this->multipleValueSeparator) !== false) {
                    $elementMultiples = explode($this->multipleValueSeparator, $value);
                    foreach ($elementMultiples as $multipleValue) {
                        $elementValues[] = $multipleValue;
                    }
                } else {
                    $elementValues[] = $value;
                }
            }
            $processorValues = $elementValues;
        }

        $this->radialItems = array_count_values($processorValues);
        arsort($this->radialItems);
        $this->checkValueLimit();
        $this->radialItems = array_splice($this->radialItems, 0, $this->valueLimit, true);
        $this->radialItems[''] = null;
        $this->radialItems = array_filter($this->radialItems);


        foreach ($this->documentCollection->getDocumentResults() as $documentKey => $document) {
            $this->documentScore = 0;
            $elementContents = mb_strtolower($this->documentCollection->getDocumentElement($documentKey, $this->element));

            foreach ($this->radialItems as $radialItem => $radialItemCount) {
                if (mb_strpos($elementContents, $radialItem) !== false) {
                    $this->documentScore += ($radialItemCount / 100);
                }
            }

            if(!isset($this->temporaryRankedDocuments[$documentKey])) {
                $this->temporaryRankedDocuments[$documentKey] = 0;
            }
            $this->temporaryRankedDocuments[$documentKey] += ($this->boost * $this->documentScore);
        }

        $this->storePartialRankedDocuments();
    }

    private function checkValueLimit()
    {
        if (!is_numeric($this->valueLimit) || $this->valueLimit <= 0) {
            $this->valueLimit = self::DEFAULTVALUELIMIT;
        }
    }
}
                
                

/* TermOrderSearch.php 
namespace T4\PHPSearchLibrary\ProcessorFactory;

use T4\PHPSearchLibrary\ProcessorFactory\Abstracts\Processor;

use \RuntimeException;
use \InvalidArgumentException;
use \LengthException;
use \OutOfBoundsException;
use \UnderflowException;
 */

class TermOrderSearch extends Processor
{
    private $queryPosition;

    public function runProcessor()
    {
        $this->initialiseProcessor();

        foreach ($this->documentCollection->getDocumentResults() as $documentKey => $documentValue) {
            $elementContents = mb_strtolower($this->documentCollection->getDocumentElement($documentKey, $this->element));

            foreach ($this->query as $query) {
                $this->queryPosition = mb_strpos($elementContents, $query);

                if ($this->queryPosition === false) {
                    continue 2;
                } else {
                    $this->queryPosition++;
                }
                $modifier = $this->calculateModifier();

                
                if(!isset($this->temporaryRankedDocuments[$documentKey])) {
                    $this->temporaryRankedDocuments[$documentKey] = 0;
                }
                $this->temporaryRankedDocuments[$documentKey] += ($this->boost * $modifier);
            }
        }

        $this->storePartialRankedDocuments();
    }

    private function calculateModifier()
    {
        return round(1 / $this->queryPosition, 3);
    }
}
                
                

/* ProcessorFactory.php 
namespace T4\PHPSearchLibrary;

use T4\PHPSearchLibrary\ProcessorFactory\FrequencySearch; 
use T4\PHPSearchLibrary\ProcessorFactory\CompoundSearch; 
use T4\PHPSearchLibrary\ProcessorFactory\TermOrderSearch; 
use T4\PHPSearchLibrary\ProcessorFactory\ProximitySearch; 
use T4\PHPSearchLibrary\ProcessorFactory\QueryVolumeSearch; 
use T4\PHPSearchLibrary\ProcessorFactory\RadialPatternSearch; 

use \RuntimeException;
use \InvalidArgumentException;
use \LengthException;
use \OutOfBoundsException;
use \UnderflowException;
 */

class ProcessorFactory
{
    public static function getInstance($processor, $documentCollection)
    {
        switch ($processor) {
            case 'FrequencySearch':
                return new FrequencySearch($documentCollection);
                break;
            
            case 'CompoundSearch':
                return new CompoundSearch($documentCollection);
                break;

            case 'TermOrderSearch':
                return new TermOrderSearch($documentCollection);
                break;

            case 'ProximitySearch':
                return new ProximitySearch($documentCollection);
                break;

            case 'QueryVolumeSearch':
                return new QueryVolumeSearch($documentCollection);
                break;

            case 'RadialPatternSearch':
                return new RadialPatternSearch($documentCollection);
                break;

            default:
                throw new RuntimeException('No instance of '.$processor.' could be created');
                break;
        }
    }
}
                
                

/* QueryFormatter.php 
namespace T4\PHPSearchLibrary\QueryFormatterFactory\Abstracts;

use T4\PHPSearchLibrary\QueryHandlerFactory\QueryHandler;
use \RuntimeException;
use \InvalidArgumentException;
use \LengthException;
use \OutOfBoundsException;
use \UnderflowException;
 */

abstract class QueryFormatter
{
    protected $queryHandler;

    public function __construct(QueryHandler $queryHandler)
    {
        $this->queryHandler = $queryHandler;
    }

    public function setMember($name, $value)
    {
        $this->$name = $value;
    }

    abstract public function format();
}
                
                

/* FormatQueriesAsDelimitedValues.php 
namespace T4\PHPSearchLibrary\QueryFormatterFactory;

use T4\PHPSearchLibrary\QueryFormatterFactory\Abstracts\QueryFormatter;

use \RuntimeException;
use \InvalidArgumentException;
use \LengthException;
use \OutOfBoundsException;
use \UnderflowException;
 */

class FormatQueriesAsDelimitedValues extends QueryFormatter
{
    protected $delimiter;
    protected $queryMarkup = null;
    protected $showQueries = array();

    public function format()
    {
        if (is_string($this->delimiter)) {

            $searchTerms = $this->queryHandler->getSearchTerms();
            if (!is_null($this->queryMarkup)) {
                foreach ($searchTerms as &$term) {
                    $term = '<'.$this->queryMarkup.'>'.$term.'</'.$this->queryMarkup.'>';
                }
            }

            return implode($this->delimiter, $searchTerms);
        } else {
            throw new InvalidArgumentException("Delimiter must be of type string");
        }
    }
}
                
                

/* FormatQueryAsArray.php 
namespace T4\PHPSearchLibrary\QueryFormatterFactory;

use T4\PHPSearchLibrary\QueryFormatterFactory\Abstracts\QueryFormatter;

use \RuntimeException;
use \InvalidArgumentException;
use \LengthException;
use \OutOfBoundsException;
use \UnderflowException;
 */

class FormatQueryAsArray extends QueryFormatter
{
    private $retrievedQueries = array();
    protected $excludedQueries = array();

    public function format()
    {   
        $values = $this->queryHandler->getQueryValuesForPrint();
        if(!empty($values)) {
            foreach ($values as $queryKey => $queryValue) {
                if(!in_array($queryKey, $this->excludedQueries)) {

                    if (!is_array($queryValue)) {
                        $this->retrievedQueries[$queryKey] = $queryValue;
                    } else {
                        foreach ($queryValue as $subQueryValue) {
                            $this->retrievedQueries[$queryKey][] = $subQueryValue;
                        }
                    }
                }
            }

            return $this->retrievedQueries;
        }

        return array();
    }
}
                
                

/* FormatQueryAsHiddenInput.php 
namespace T4\PHPSearchLibrary\QueryFormatterFactory;

use T4\PHPSearchLibrary\QueryFormatterFactory\Abstracts\QueryFormatter;

use \RuntimeException;
use \InvalidArgumentException;
use \LengthException;
use \OutOfBoundsException;
use \UnderflowException;
 */

class FormatQueryAsHiddenInput extends QueryFormatter
{
    private $output = '';
    protected $excludedQueries = array();

    public function format()
    {
        //foreach ($this->queryHandler->getQueryArray() as $queryKey => $queryValue) {
        foreach ($this->queryHandler->getNonStemmedQueries() as $queryKey => $queryValue) {
            if (!in_array($queryKey, $this->excludedQueries)) {
                foreach ($queryValue as $query) {
                    $this->output .= '<input type="hidden" name="'.$queryKey.'" data-cookie="T4_persona" value="'.$query.'" />';
                }
            }
        }

        return $this->output;
    }
}
                
                

/* FormatQueryAsURLString.php 
namespace T4\PHPSearchLibrary\QueryFormatterFactory;

use T4\PHPSearchLibrary\QueryFormatterFactory\Abstracts\QueryFormatter;

use \RuntimeException;
use \InvalidArgumentException;
use \LengthException;
use \OutOfBoundsException;
use \UnderflowException;
 */

class FormatQueryAsURLString extends QueryFormatter
{
    private $retrievedQueries = array();
    protected $excludedQueries = array();

    public function format()
    {
        $values = $this->queryHandler->getQueryValuesForPrint();
        if(!empty($values)) {
            foreach ($values as $queryKey => $queryValue) {
                if(!in_array($queryKey, $this->excludedQueries)) {
                    if (!is_array($queryValue)) {
                        $this->retrievedQueries[] = $queryKey.'='.str_replace(" ","+",$queryValue);
                    } else {
                        foreach ($queryValue as $subQueryValue) {
                            $this->retrievedQueries[] = $queryKey.'='.str_replace(" ","+",$subQueryValue);
                        }
                    }
                }
            }

            $this->retrievedQueries = implode('&', $this->retrievedQueries);

            return $this->retrievedQueries;
        }
        return '';
    }
}
                
                

/* QueryFormatterFactory.php 
namespace T4\PHPSearchLibrary;

use T4\PHPSearchLibrary\QueryFormatterFactory\FormatQueriesAsDelimitedValues;
use T4\PHPSearchLibrary\QueryFormatterFactory\FormatQueryAsURLString;
use T4\PHPSearchLibrary\QueryFormatterFactory\FormatQueryAsArray;
use T4\PHPSearchLibrary\QueryFormatterFactory\FormatQueryAsHiddenInput;

use \RuntimeException;
use \InvalidArgumentException;
use \LengthException;
use \OutOfBoundsException;
use \UnderflowException;
 */

class QueryFormatterFactory
{
    public static function getInstance($handler, $queryHandler)
    {
        switch ($handler) {
            case 'FormatQueriesAsDelimitedValues':
                return new FormatQueriesAsDelimitedValues($queryHandler);
                break;

            case 'FormatQueryAsURLString':
                return new FormatQueryAsURLString($queryHandler);
                break;

            case 'FormatQueryAsArray':
                return new FormatQueryAsArray($queryHandler);
                break;

            case 'FormatQueryAsHiddenInput':
                return new FormatQueryAsHiddenInput($queryHandler);
                break;

            default:
                throw new RuntimeException('No instance of '.$handler.' could be created');
                break;
        }
    }
}
                
                

/* AutocompleteQueryHandler.php 
namespace T4\PHPSearchLibrary\QueryHandlerFactory;

use \RuntimeException;
use \InvalidArgumentException;
use \LengthException;
use \OutOfBoundsException;
use \UnderflowException;
use \UnexpectedValueException;
 */

class AutocompleteQueryHandler
{
    private $currentQuery;
    private $query = array();
    private $stopWords = array( '/\band\b/is',
                                '/\bof\b/is',
                                '/\bin\b/is',
                                '/\bor\b/is',
                                '/\bwith\b/is',
                                '/\bthe\b/is',
                                '/\bat\b/is',
                            );

    public function __construct($currentQuery)
    {
        $this->currentQuery = $this->queryIsValid($currentQuery);
    }

    private function queryIsValid($query)
    {
        if (isset($_GET['term']) && !empty($_GET['term'])) {
            $query = filter_var($_GET['term'], FILTER_SANITIZE_STRING);
            if ($query === false) {
                throw new UnexpectedValueException('Autocomplete query couldn\'t be sanitised.', 1);
            } else {
                return $query;
            }
        } else {
            throw new InvalidArgumentException('Autocomplete query wasn\'t properly submitted.', 2);
        }
    }

    public function handleQuery()
    {
        $query = explode(' ', $this->currentQuery);
        $tokens = array();

        foreach ($query as $token) {
            $token = $this->runPregReplace($this->stopWords, '', $token);
            $tokens[] = mb_strtolower($token);
        }

        $this->query = array_filter($tokens);
    }

    private function runPregReplace($pattern, $replacement = '', $subject)
    {
        return trim(preg_replace($pattern, $replacement, $subject));
    }

    public function setStopWords($stopWords)
    {
        $this->stopWords = $stopWords;
    }

    public function getQuery()
    {
        return $this->query;
    }

    public function doQuerysExist()
    {
        if (empty($this->query)) {
            return false;
        } else {
            return true;
        }
    }

    public function getQueryAsString()
    {
        return implode(' ', $this->query);
    }
}
                
                

/* QueryHandler.php 
namespace T4\PHPSearchLibrary\QueryHandlerFactory;

use T4\PHPSearchLibrary\Stemmer;

use \RuntimeException;
use \InvalidArgumentException;
use \LengthException;
use \OutOfBoundsException;
use \UnderflowException;
 */

class QueryHandler
{
    private $currentQuery;
    private $query = array();
    private $searchTerms = array();
    private $stopWords = array(
                            '/\band\b/is',
                            '/\bof\b/is',
                            '/\bin\b/is',
                            '/\bor\b/is',
                            '/\bwith\b/is',
                            '/\bthe\b/is',
                            '/\bat\b/is'
                        );
    private $ignoreQueries = array('page', 'paginate');
    private $queriesExist = false;
    private $charRegex = '';
    private $stemmer;
    private $stemQuery = false;
    private $queriesToStem = array();
    private $dontTokenize = array();
    private $dontRemoveStopWords = array();
    private $nonStemmedQueries = array();
    private $prequery = array();

    public function __construct($currentQuery)
    {
        if ($this->queryIsValid($currentQuery)) {
            $this->currentQuery = $currentQuery;
        }
    }

    public function setStopWords($stopWords)
    {
        $this->stopWords = $stopWords;
    }

    public function setDontTokenize($dontTokenize)
    {
        $this->dontTokenize = $dontTokenize;
    }

    public function setDontRemoveStopwords($dontRemoveStopwords)
    {
        $this->dontRemoveStopWords = $dontRemoveStopwords;
    }

    public function setIgnoreQueries($ignoreQueries)
    {
        array_push($ignoreQueries, 'page', 'paginate');
        $this->ignoreQueries = $ignoreQueries;
    }

    public function addCharactherToGenericRegex($chars)
    {
        $specialChars = array("(",")","\\","/","^","$","[","]","{","}",".","*","+","?","|","<",">","-","&");

        foreach($chars as $key => &$char) {
            $key = array_search($char, $specialChars);
            $char ="\\".$char; 
        }
        $this->charRegex = implode('',$chars);
    }

    public function handleQuery()
    {
        $query = explode('&', $this->currentQuery);
        $params = array();

        foreach ($query as $parameter) {
            if (empty($parameter)) {
                continue;
            }
            
            list($name, $value) = explode('=', $parameter);

            if ($this->parameterIsValid($name, $value)) {
                $name = $this->sanitiseAndDecode($name);
                $value = $this->sanitiseAndDecode($value);
                
                
                /* Beware, regexp be here
                 * These patterns may be different to the usual regex patterns seen before, these ones will work for unicode codepoints.
                 * See http://www.regular-expressions.info/unicode.html for useful information
                 *
                 * \p{L&}   = a letter that exists in lowercase and uppercase variants
                 * \p{M}*+  = matches zero or more code points that are combining marks (this should follow \p{L&} to catch accents)
                 * \p{Nd}   = a digit zero through nine in any script except ideographic scripts
                 * \p{Pd}   = any kind of hyphen or dash
                 * &        = matches '&' character, if any other characters need to be added place them after this one
                 */
                $value = $this->runPregReplace('/[^\p{L&}\p{M}*+\p{Nd}\p{Pd}&,'.$this->charRegex.'>\s]+/ui', '', $value);
                
                if (in_array($name, $this->dontRemoveStopWords) === false) {
                    $value = $this->runPregReplace($this->stopWords, '', $value);
                }

                if(isset($this->prequery[$name]) && !empty($this->prequery[$name]) && !is_array($this->prequery[$name])) {
                    $first_value = $this->prequery[$name];
                    unset($this->prequery[$name]);
                    $this->prequery[$name] = array();
                    $this->prequery[$name][] = $first_value;
                    $this->prequery[$name][] = $value;
                } elseif(!isset($this->prequery[$name])) {
                    $this->prequery[$name] = $value;
                } else {
                    $this->prequery[$name][] = $value;
                }

                $displayValue = $value;


                if (in_array($name, $this->dontTokenize)) {
                    $tokenizedQuery[] = $value;
                } else {
                    $tokenizedQuery = array_unique(explode(' ', $value));
                }

                foreach ($tokenizedQuery as $token) {
                    if ($this->stemQuery === true && in_array($name, $this->queriesToStem)) {
                        $params[$name][] = mb_strtolower($token);
                        $this->nonStemmedQueries[$name][] = mb_strtolower($token);
                        $params[$name][] = mb_strtolower($this->stemmer->stem($token));
                    } else {
                        $params[$name][] = mb_strtolower($token);
                        $this->nonStemmedQueries[$name][] = mb_strtolower($token);
                    }
                }
                if (!in_array($name, $this->ignoreQueries)) {
                    $this->searchTerms[] = htmlspecialchars($displayValue);
                    $this->queriesExist = true;
                }
                $tokenizedQuery = null;
            }
        }

        foreach ($params as $getElement => $queries) {
            $params[$getElement] = array_unique($queries);
        }
        foreach ($this->nonStemmedQueries as $getElement => $queries) {
            $this->nonStemmedQueries[$getElement] = array_unique($queries);
        }

        foreach ($params as &$value) {
            $value = array_filter($value);
        }
        unset($value);
        foreach ($this->nonStemmedQueries as &$value) {
            $value = array_filter($value);
        }
        unset($value);

        $this->query = $params;
    }

    private function queryIsValid($query)
    {
        if (!empty($query) && (strpos($query, '=') !== false)) {
            return true;
        } else {
            return false;
        }
    }

    private function parameterIsValid($name, $value)
    {
        if ((is_numeric($name) || !empty($name)) && (is_numeric($value) || !empty($value))) {
            return true;
        } else {
            return false;
        }
    }

    private function sanitiseAndDecode($entry)
    {
        return strip_tags(urldecode($entry));
    }

    private function runPregReplace($pattern, $replacement = '', $subject)
    {
        return trim(preg_replace($pattern, $replacement, $subject));
    }

    // private function runStrReplace($search, $replace = '', $subject)
    // {
    //     return trim(str_replace($search, $replace, $subject));
    // }

    public function getQueryArray()
    {
        return $this->query;
    }

    public function getNonStemmedQueries()
    {
        return $this->nonStemmedQueries;
    }

    public function getSearchTerms()
    {
        return $this->searchTerms;
    }

    public function getQueryValue($key)
    {
        if (isset($this->query[$key]) === true) {
            return $this->query[$key];
        } else {
            throw new OutOfBoundsException("Non-existant key used to access query array: ".$key);
        }
    }

    public function getQueryValueForPrint($key)
    {
        if (isset($this->prequery[$key]) === true && !is_array($this->prequery[$key])) {
            return $this->prequery[$key];
        } elseif(is_array($this->prequery[$key])) {
            return implode (",", $this->prequery[$key]);
        }
        return null;
    }

    public function getQueryValuesForPrint()
    {
        if (!empty($this->prequery) === true) {
            return $this->prequery;
        }
        return null;
    }

    public function isQuerySet($key)
    {
        return isset($this->query[$key]);
    }

    public function doQuerysExist()
    {
        return $this->queriesExist;
    }

    public function stemQuery($queriesToStem)
    {
        $this->stemmer = new Stemmer();
        $this->stemQuery = true;
        $this->queriesToStem = $queriesToStem;
    }
}
                
                

/* QueryHandlerFactory.php 
namespace T4\PHPSearchLibrary;

use T4\PHPSearchLibrary\QueryHandlerFactory\QueryHandler;
use T4\PHPSearchLibrary\QueryHandlerFactory\AutocompleteQueryHandler;

use \RuntimeException;
use \InvalidArgumentException;
use \LengthException;
use \OutOfBoundsException;
use \UnderflowException;
 */

class QueryHandlerFactory
{
    public static function getInstance($handler, $queryString)
    {
        switch ($handler) {
            case 'QueryHandler':
                return new QueryHandler($queryString);
                break;

            case 'AutocompleteQueryHandler':
                return new AutocompleteQueryHandler($queryString);
                break;

            default:
                throw new RuntimeException('No instance of '.$handler.' could be created');
                break;
        }
    }
}
                
                

/* JsonResponse.php 
namespace T4\PHPSearchLibrary\Responses\Abstracts;

use \RuntimeException;
use \InvalidArgumentException;
use \LengthException;
use \OutOfBoundsException;
use \UnderflowException;
 */

class JsonResponse
{
    protected $data = array();

    public function send()
    {
        $this->data = json_encode($this->data);
        echo $this->data;
       	return;
    }
}
                
                

/* JsonErrorResponse.php 
namespace T4\PHPSearchLibrary\Responses;

use T4\PHPSearchLibrary\Responses\Abstracts\JsonResponse;

use \RuntimeException;
use \InvalidArgumentException;
use \LengthException;
use \OutOfBoundsException;
use \UnderflowException;
 */

class JsonErrorResponse extends JsonResponse
{
    public function __construct($message, $value = null)
    {
        $this->data[0]['label'] = $message;
        if (is_null($value)) {
            $this->data[0]['value'] = '';
        } else {
            $this->data[0]['value'] = $value;
        }
    }
}
                
                

/* JsonSuccessResponse.php 
namespace T4\PHPSearchLibrary\Responses;

use T4\PHPSearchLibrary\Responses\Abstracts\JsonResponse;

use \RuntimeException;
use \InvalidArgumentException;
use \LengthException;
use \OutOfBoundsException;
use \UnderflowException;
 */


class JsonSuccessResponse extends JsonResponse
{
    public function __construct(array $responses)
    {   
        $i = 0;
        foreach ($responses as $response) {
            $this->data[$i]['label'] = $response['label'];
            $this->data[$i]['value'] = $response['value'];
            $i += 1;
        }
    }
}
                
                

/* Search.php 
namespace T4\PHPSearchLibrary\SearchFactory;

use T4\PHPSearchLibrary\DocumentsHandlers\Abstracts\DocumentsHandler;
use T4\PHPSearchLibrary\DocumentsHandlers\XMLHandler;
use T4\PHPSearchLibrary\DocumentsHandlers\JSONHandler;

use \RuntimeException;
use \InvalidArgumentException;
use \LengthException;
use \OutOfBoundsException;
use \UnderflowException;
 */

class Search
{
    private $documents = array();
    private $partialDocumentResults = array();
    private $combinedDocumentResults = array();
    private $documentResults = array();

    public function __construct($documentsSource, $documentsSourceType)
    {
        if (is_null($documentsSourceType)) {
            $documentsSourceType = pathinfo($documentsSource);
            $documentsSourceType = $documentsSourceType['extension'];
        }

        if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) {
            $protocol = true;
        } else {
            $protocol = false;
        }

        if (strtolower($documentsSourceType) === "xml") {
            $handler = new XMLHandler($protocol, $documentsSource);
        } else if (strtolower($documentsSourceType) === "json") {
            $handler = new JSONHandler($protocol, $documentsSource);
        }

        // Ensure that $handler implements the DocumentHandler interface
        if ($handler instanceof DocumentsHandler === false) {
            throw new RuntimeException('$handler must implement the DocumentsHandler');
        }

        $this->documents = $handler->getParsedDocuments();
    }

    public function __destruct()
    {
        $this->documents = null;
        $this->documentResults = null;
    }

    public function getDocuments()
    {
        return $this->documents;
    }

    public function getDocumentResults()
    {
        return $this->documentResults;
    }

    public function getPartialDocumentResults()
    {
        return $this->partialDocumentResults;
    }

    private function emptyPartialDocumentResults()
    {
        $this->partialDocumentResults = null;
    }

    public function storePartialDocumentResults($temporaryDocumentResults)
    {
        $this->partialDocumentResults[] = $temporaryDocumentResults;
    }

    public function getCombinedDocumentResults()
    {
        return $this->combinedDocumentResults;
    }

    private function emptyCombinedDocumentResults()
    {
        $this->combinedDocumentResults = null;
    }

    public function storeCombinedDocumentResults($temporaryDocumentResults)
    {
        $this->combinedDocumentResults[] = $temporaryDocumentResults;
    }

    public function combineResults()
    {
        $temporaryCombinedResults = array();

        if (!array_filter($this->combinedDocumentResults) === false) {
            foreach ($this->combinedDocumentResults as $key => $value) {
                if (!is_null($value)) {
                    $temporaryCombinedResults += $value;
                }
            }
        }

        $this->storePartialDocumentResults($temporaryCombinedResults);
        $this->emptyCombinedDocumentResults();
    }

    public function intersectDocumentResults()
    {
        $filterCount = count($this->partialDocumentResults);

        if ($filterCount > 1) {
            $this->documentResults = call_user_func_array('array_intersect_key', $this->partialDocumentResults);
        } elseif ($filterCount === 1) {
            foreach ($this->partialDocumentResults[0] as $key => $value) {
                $this->documentResults[$key] = $value;
            }
        }

        $this->emptyPartialDocumentResults();
    }
}
                
                

/* SearchFactory.php 
namespace T4\PHPSearchLibrary;

use T4\PHPSearchLibrary\SearchFactory\Search;

use \RuntimeException;
use \InvalidArgumentException;
use \LengthException;
use \OutOfBoundsException;
use \UnderflowException;
 */

class SearchFactory
{
    public static function getInstance($search, $documentsSource, $documentsSourceType = null)
    {
        switch ($search) {
            case 'Search':
                return new Search($documentsSource, $documentsSourceType);
                break;

            default:
                throw new RuntimeException('No instance of '.$search.' could be created');
                break;
        }
    }
}
                
                

/* Stemmer.php 
namespace T4\PHPSearchLibrary;

use \RuntimeException;
use \InvalidArgumentException;
use \LengthException;
use \OutOfBoundsException;
use \UnderflowException;
 */

class Stemmer
{
    private $vowels = array('a', 'e', 'i', 'o', 'u', 'y');
    private $characters;
    private $character;
    private $r1;
    private $r2;

    public function __construct()
    {
    }

    public function stem($word)
    {
        $this->r1 = null;
        $this->r2 = null;
        $this->characters = str_split($word);

        if (count($this->characters) > 2) {
            $this->removeApostrophes();
            $this->markYVowels();
            $this->findRegions();
            $this->removePluralisedSuffixes();
            $this->removeAdverbSuffixes();
            $this->replaceYSuffixes();
            $this->modifyMiscSuffixes();
            $this->unmarkYVowels();
        }

        return implode($this->characters);
    }

    private function findRegions()
    {
        $rKeys = array();
        $previousCharacter = null;

        foreach ($this->characters as $position => $this->character) {
            switch ($previousCharacter) {
                case null:
                    $previousCharacter = $this->character;
                    break;
                
                default:
                    if ($this->characterIsVowel($this->character) === false && $this->characterIsVowel($previousCharacter) === true) {
                        $previousCharacter = $this->character;
                        $rKeys[] = $position;
                    } else {
                        $previousCharacter = $this->character;
                    }
                    break;
            }
        }

        if (count($rKeys) === 1) {
            $this->r1 = implode(array_slice($this->characters, $rKeys[0] + 1));
        } else if (count($rKeys) > 1) {
            $this->r1 = implode(array_slice($this->characters, $rKeys[0] + 1));
            $this->r2 = implode(array_slice($this->characters, $rKeys[1] + 1));
        }
    }

    private function characterIsVowel($character)
    {
        if (in_array($character, $this->vowels)) {
            return true;
        } else {
            return false;
        }
    }

    private function markYVowels()
    {
        if ($this->characters[0] === 'y') {
            $this->characters[0] = 'Y';
        }

        $previousCharacter = null;
        $i = 0;

        foreach ($this->characters as $this->character) {
            if (is_null($previousCharacter)) {
                $previousCharacter = $this->character;
                $i += 1;
            } else if ($this->character === 'y' && $this->characterIsVowel($previousCharacter) === true) {
                $previousCharacter = $this->character;
                $this->characters[$i] = 'Y';
                $i += 1;
            } else {
                $previousCharacter = $this->character;
                $i += 1;
            }
        }
    }

    private function removeApostrophes()
    {
        $word = implode($this->characters);
        $search = array("s'", "'s", "'");
        $word = str_replace($search, '', $word);

        $this->characters = str_split($word);
    }

    private function removePluralisedSuffixes()
    {
        $word = implode($this->characters);
        $word = preg_replace('/([a-z0-9]{2,})(ies|ied)$/', '$1i', $word);
        $word = preg_replace('/([a-z0-9]{1})(ies|ied)$/', '$1ie', $word);
        $word = preg_replace('/([qwrtypsdfghjklzxcvbnm]{1})s$/', '$1', $word);
        $word = str_replace('sses', 'ss', $word);
        $this->characters = str_split($word);
    }

    private function removeAdverbSuffixes()
    {
        $word = implode($this->characters);

        if (!empty($this->r1) || !is_null($this->r1)) {
            if (preg_match('/(eed|eedly)$/', $this->r1)) {
                $word = preg_replace('/(eed|eedly)$/', 'ee', $word); // If eed, or eedly is in r1 replace by ee
            }
        }

        if (preg_match('/([aeiouy]*?)(ed|edly|ing|ingly)$/', $word)) {
            $word = preg_replace('/(ed|edly|ing|ingly)$/', '', $word); // Delete ed, edly, ing, ingly if the preceding word part contains a vowel
            $word = preg_replace('/(at|bl|iz)$/', '$1e', $word); // If the word ends in at, bl, or iz add e
            $word = preg_replace('/(.)\1{1,}$/', '$1', $word); // If the word ends with a double remove the last letter
        }

        $this->characters = str_split($word);
    }

    private function replaceYSuffixes()
    {
        $word = implode($this->characters);

        if (preg_match('/([qwrtypsdfghjklzxcvbnm]{1})(y|Y)$/', $word) && strlen($word) > 2) {
            $word = preg_replace('/(y|Y)$/', 'i', $word);
        }

        $this->characters = str_split($word);
    }

    private function modifyMiscSuffixes()
    {
        $word = implode($this->characters);

        if (!empty($this->r1) || !is_null($this->r1)) {
            if (preg_match('/(tional)$/', $this->r1)) {
                $word = preg_replace('/(tional)$/', 'tion', $word);
            }
            if (preg_match('/(enci)$/', $this->r1)) {
                $word = preg_replace('/(enci)$/', 'ence', $word);
            }
            if (preg_match('/(anci)$/', $this->r1)) {
                $word = preg_replace('/(anci)$/', 'ance', $word);
            }
            if (preg_match('/(abli)$/', $this->r1)) {
                $word = preg_replace('/(abli)$/', 'able', $word);
            }
            if (preg_match('/(entli)$/', $this->r1)) {
                $word = preg_replace('/(entli)$/', 'ent', $word);
            }
            if (preg_match('/(izer|ization)$/', $this->r1)) {
                $word = preg_replace('/(izer|ization)$/', 'ize', $word);
            }
            if (preg_match('/(iser|isation)$/', $this->r1)) {
                $word = preg_replace('/(iser|isation)$/', 'ise', $word);
            }
            if (preg_match('/(ational|ation|ator)$/', $this->r1)) {
                $word = preg_replace('/(ational|ation|ator)$/', 'ate', $word);
            }
            if (preg_match('/(alism|aliti|alli)$/', $this->r1)) {
                $word = preg_replace('/(alism|aliti|alli)$/', 'al', $word);
            }
            if (preg_match('/(fulness)$/', $this->r1)) {
                $word = preg_replace('/(fulness)$/', 'ful', $word);
            }
            if (preg_match('/(ousli|ousness)$/', $this->r1)) {
                $word = preg_replace('/(ousli|ousness)$/', 'ous', $word);
            }
            if (preg_match('/(iveness|iviti)$/', $this->r1)) {
                $word = preg_replace('/(iveness|iviti)$/', 'ive', $word);
            }
            if (preg_match('/(biliti|bli)$/', $this->r1)) {
                $word = preg_replace('/(biliti|bli)$/', 'ble', $word);
            }
            if (preg_match('/([l]{1})(ogi)$/', $this->r1)) {
                $word = preg_replace('/(ogi)$/', 'og', $word);
            }
            if (preg_match('/(fulli)$/', $this->r1)) {
                $word = preg_replace('/(fulli)$/', 'ful', $word);
            }
            if (preg_match('/(lessli)$/', $this->r1)) {
                $word = preg_replace('/(lessli)$/', 'less', $word);
            }
            if (preg_match('/([cdeghkmnrt]{1})(li)$/', $this->r1)) {
                $word = preg_replace('/(li)$/', '', $word);
            }
            if (preg_match('/(alize)$/', $this->r1)) {
                $word = preg_replace('/(alize)$/', 'al', $word);
            }
            if (preg_match('/(alise)$/', $this->r1)) {
                $word = preg_replace('/(alise)$/', 'al', $word);
            }
            if (preg_match('/(icate|iciti|ical)$/', $this->r1)) {
                $word = preg_replace('/(icate|iciti|ical)$/', 'ic', $word);
            }
            if (preg_match('/(ful|ness)$/', $this->r1)) {
                $word = preg_replace('/(ful|ness)$/', '', $word);
            }
            if (preg_match('/(ative)$/', $this->r2)) {
                $word = preg_replace('/(ative)$/', '', $word);
            }
            if (preg_match('/(al|ance|ence|er|ic|able|ible|ant|ement|ment|ent|ism|ate|iti|ous|ive|ize)$/', $this->r2)) {
                $word = preg_replace('/(al|ance|ence|er|ic|able|ible|ant|ement|ment|ent|ism|ate|iti|ous|ive|ize)$/', '', $word);
            }
            if (preg_match('/([st]{1})(ion)$/', $this->r2)) {
                $word = preg_replace('/([st]{1})(ion)$/', '', $word);
            }
            if (preg_match('/(ll)$/', $this->r2)) {
                $word = preg_replace('/(ll)$/', 'l', $word);
            }
            if (preg_match('/(e)$/', $this->r2)) {
                $word = preg_replace('/(e)$/', '', $word);
            }
        }

        $this->characters = str_split($word);
    }

    private function unmarkYVowels()
    {
        $word = implode($this->characters);

        $word = str_replace('Y', 'y', $word);

        $this->characters = str_split($word);
    }
}
                
                

/* T4Version.php 
namespace T4\PHPSearchLibrary;

use \RuntimeException;
use \InvalidArgumentException;
use \LengthException;
use \OutOfBoundsException;
use \UnderflowException;
 */

class T4Version
{
    //Start Version
    static private $version    = "0.0.1";
    //End Version

    static public function getVersion()
    {
        return SELF::$version;
    }
}
                