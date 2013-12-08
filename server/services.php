<br/>Retrieving concepts... <br/>

<?php

include_once(__DIR__ . '/model/modelMapper.php');
include_once(__DIR__ . '/model/alignment.php');
include_once(__DIR__ . '/model/attribute.php');
include_once(__DIR__ . '/model/concept.php');
include_once(__DIR__ . '/model/schema.php');
include_once(__DIR__ . '/model/conceptMaterializer.php');

class ConceptMaterialized{

	private $conceptsMapper;// = new ModelMapper(get_class(new ConceptMaterializer()));

	function __construct(){
		$this->conceptsMapper = new ModelMapper(get_class(new ConceptMaterializer()));
	}
	

//Services definition: S0101
//requires reimplementation for the link hashing
  function ListMaterializedConceptsForm($formId) {
    $concepts = array();
	$materializedConcepts = $this->conceptsMapper->loadAll();//loadBy("formId", $formId);
    foreach ($materializedConcepts as $materializedConcept) {
      $concepts[] = $materializedConcept->getNameConcept();
    }
    return $concepts;
  }

//Services definition: S0201
function ListConcepts() {
    $concepts = array();
    $queryConcepts = $this->conceptsMapper->loadAll();
    foreach ($queryConcepts as $queryConcept) {
      $concepts[] = $queryConcept->getNameConcept();
    	}
    return $concepts;
	}

//Services definition: S0202
function MaterializeConcept($idForm, $idConcept, $conceptName){
	$temp = new ConceptMaterializer();	
	$temp->idForm = $idForm;
	$temp->idConcept = $idConcept;
	$temp->name = $conceptName;
	return $this->conceptsMapper->save($temp);

}

//Services definition: S0301
function UpdateMaterializedConcept($id, $name){
	$temp = $this->conceptsMapper->load($id);
	$temp->name = $name;
	return $this->conceptsMapper->save($temp);
}


//Services definition: S0401
function UnMaterializeConcept($id) {
	$temp = $this->conceptsMapper->load($id);
	$this->conceptsMapper->delete($temp);
	}

//Services definition: S0501
function ListAlignmentsMC($idMC){
	$alignmentsMapper = new ModelMapper(get_class(new Alignment()));
	$alignments = $alignmentsMapper->loadBy("conceptMaterializerId", $idMC);    
    return $alignments;
}

//Services definition: S0602
function ListAttributesConcept($idMC){
	$attributesMapper = new ModelMapper(get_class(new Attribute()));
	$attributesList = $attributesMapper->loadBy("tableId", $this->conceptsMapper->load($idMC)->tableId);
	$attributes = array();
	foreach ($attributesList as $attribute) {
      $attributes[] = $attribute->getName();
    }
	return $attributes;
	}

//Services definition: S0603
function CreateAlignment($idMC, $idField, $idAttribute){
	$alignmentMapper = new ModelMapper(get_class(new Alignment()));
	$temp = new Alignment();	
	$temp->conceptMaterializerId = $idMC;
	$temp->fieldId = $idField;
	$temp->attributeId = $idAttribute;
	return $alignmentMapper->save($temp);
}

//Services definition: S0801
function DeleteAlignment($idMC, $idField, $idAttribute){
	$alignmentsMapper = new ModelMapper(get_class(new Alignment()));
	$alignments = $alignmentsMapper->loadBy("conceptMaterializerId",$idMC);
	if (!empty($alignments)){
		foreach($alignments as $alignment){
			if($alignment->fieldId == $idField && $alignment->attributeId == $idAttribute){
				$alignmentsMapper->delete($alignment);
			}			
		}
	}
	else
		echo "No Alignments matching the criteria!";
	//$this->alignmentsMapper->delete($temp);
	//return $alignmentsMapper->delete($temp);
}

//Services definition: S0901
function ListSchemas(){
	$schemasMapper = new ModelMapper(get_class(new Schema()));
	return $schemasMapper->loadAll();
}

//Services definition: S1001
function ListConceptSchemas($idSchema){
	$schemasMapper = new ModelMapper(get_class(new Schema()));
	return $schemasMapper->load($idSchema);
}

//Services definition: S1002
function CreateSchemaEmpty($name, $author){
	$schemasMapper = new ModelMapper(get_class(new Schema()));
	$temp = new Schema();	
	$temp->name = $name;
	$temp->author = $author;
	return $schemasMapper->save($temp);
}

//Services definition: S1101
function UpdateSchema($idSchema, $name, $author){
	$schemasMapper = new ModelMapper(get_class(new Schema()));
	$temp = new Schema();	
	$temp->id = $idSchema;
	$temp->name = $name;
	$temp->author = $author;
	return $schemasMapper->save($temp);
}

//Services definition S1201
function DeleteSchema($idSchema){
	$schemasMapper = new ModelMapper(get_class(new Schema()));
	$temp = $schemasMapper->load($idSchema);
	$schemasMapper->delete($temp);
	}

}

$s = new ConceptMaterialized();
//Testing S0101:
$tst = $s->ListMaterializedConceptsForm(2);
echo "<br/>ListMaterializedConceptsForm(2): ".$tst;

//Testing S0201:
$tst = $s->ListConcepts();
echo "<br/>ListConcepts: "; //. $tst;
print_r($tst);
echo "<br/>";

//$s->UnMaterializeConcept(1);

//Testing save function
echo "<br/>Testing save function:";
//echo "".$s->MaterializeConcept(7771,7771,"7771");

//Testing delete function
echo "<br/>Testing delete function:";
//echo "".$s->UnMaterializeConcept(10);

//Testing update function
echo "<br/>Testing update function:";
echo "".$s->UpdateMaterializedConcept(9, "becalli");

//Testing alignments query method:
/*
echo "<br/>Testing alignments query function:";
print_r($s->ListAlignmentsMC(9));
*/

//Testing alignments query method:

/*echo "<br/>Testing Attributes query function:";
print_r($s->ListAttributesConcept(6));
$s->ListAttributesConcept(9);*/

//Testing CreateAlignment
$s->CreateAlignment(104,105,106);

//Testing DeleteAlignment
echo "<br/> testing delete alignment";
$s->DeleteAlignment(103,104,105);

//Testing ListSchemas
echo "<br/>Listing schemas: ";
print_r($s->ListSchemas());

//Testing ListConceptSchemas
echo "<br/>Listing concept schemas: ";
print_r($s->ListConceptSchemas(1));

//Testing CreateSchemaEmpty
/*$s->CreateSchemaEmpty("schema_4", "andrei");
echo "<br/>Created new schema!";*/

//Testing CreateSchemaEmpty
$s->UpdateSchema(4,"new_schema_4", "andrei_02");
echo "<br/>Updated schema!";

//Testing DeleteSchema
/*$s->DeleteSchema(3);
echo "<br/>Deleted schema!";*/

?>
