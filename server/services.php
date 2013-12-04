<br/>Retrieving concepts... <br/>

<?php

include_once(__DIR__ . '/model/modelMapper.php');
include_once(__DIR__ . '/model/conceptMaterializer.php');

class ConceptMaterialized{
//Services definition: S0101
  function ListMaterializedConceptsForm($formId) {
    $concepts = array();
    $conceptMaterializerMapper = new ModelMapper(get_class(new ConceptMaterializer()));
    $materializedConcepts = $conceptMaterializerMapper->loadBy("formId", $formId);
    foreach ($materializedConcepts as $materializedConcept) {
      $concepts[] = $materializedConcept->getNameConcept();
    }
    return $concepts;
  }

//Services definition: S0201
function ListConcepts() {
    $concepts = array();
    $conceptsMapper = new ModelMapper(get_class(new ConceptMaterializer()));
    $queryConcepts = $conceptsMapper->loadAll();
    foreach ($queryConcepts as $queryConcept) {
      $concepts[] = $queryConcept->getNameConcept();
    	}
    return $concepts;
	}

//Services definition: S0401
function UnMaterializeConcept($id) {
	$conceptsMapper = new ModelMapper(get_class(new ConceptMaterializer()));
	$conceptsMapper->delete(this);
	}

}

$s = new ConceptMaterialized();
//Testing S0101:
$tst = $s->ListMaterializedConceptsForm(2);
print "\n ListMaterializedConceptsForm(2): ";
print_r ($tst);

//Testing S0201:
$tst = $s->ListConcepts();
print "\r\n ListConcepts: ";
print_r ($tst);

//$s->UnMaterializeConcept(1);
?>
