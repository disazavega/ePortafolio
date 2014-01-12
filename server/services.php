<?php

include_once(__DIR__ . '/model/modelMapper.php');

include_once(__DIR__ . '/model/alignment.php');
include_once(__DIR__ . '/model/attribute.php');
include_once(__DIR__ . '/model/concept.php');
include_once(__DIR__ . '/model/conceptMaterialized.php');
include_once(__DIR__ . '/model/field.php');
include_once(__DIR__ . '/model/fieldInstance.php');
include_once(__DIR__ . '/model/foreignKey.php');
include_once(__DIR__ . '/model/form.php');
include_once(__DIR__ . '/model/key.php');
include_once(__DIR__ . '/model/schema.php');

class Services {

	private $conceptMapper;// = new ModelMapper(get_class(new ConceptMaterialized()));
	private $conceptMaterializedMapper; // 

	function __construct(){
		$this->conceptMapper = new ModelMapper(get_class(new Concept()));
		$this->conceptMaterializedMapper = new ModelMapper(get_class(new ConceptMaterialized()));
	}
	
    //Services definition: S0101
    //requires reimplementation for the link hashing
    function ListMaterializedConceptsForm($formId) {
        $materializedConcepts  = $this->conceptMaterializedMapper->loadBy("idForm", $formId);
        return $materializedConcepts;
    }

    //Services definition: S0201
    function ListConcepts() {
        $queryConcepts = $this->conceptMapper->loadAll();
        return $queryConcepts;
    }

    //Services definition: S0202
    function MaterializeConcept($idForm, $idConcept, $conceptName){
	$temp = new ConceptMaterialized(); 
	$temp->idForm = $idForm;
	$temp->idConcept = $idConcept;
	$temp->name = $conceptName;
	return $this->conceptMaterializedMapper->save($temp);
    }

    //Services definition: S0301
    function UpdateMaterializedConcept($id, $name, $idConcept){
        $temp = $this->conceptMaterializedMapper->load($id);
	$temp->name = $name;
        $temp->idConcept = $idConcept;
	return $this->conceptMaterializedMapper->save($temp);
    }

    //Services definition : S0302
    function RecoverMaterializedConcept($id){
        return $this->conceptMaterializedMapper->load($id);
    }

    //Services definition: S0401
    function UnMaterializeConcept($id) {
    	$temp = $this->conceptMaterializedMapper->load($id);
    	return $this->conceptMaterializedMapper->delete($temp);
    }

    //Services definition: S0501
    function ListAlignmentsMC($idMC){
	$alignmentsMapper = new ModelMapper(get_class(new Alignment()));
	$alignments = $alignmentsMapper->loadBy("idConceptMaterialized", $idMC);    
        return $alignments;
    }
    
    //Services definition : S0502
    function RecoverAttribute($id){
        $attributeMapper = new ModelMapper(get_class(new Attribute()));
        return $attributeMapper->load($id);
    }
    
    //Services definition : S0503
    function RecoverField($id){
        $fieldMapper = new ModelMapper(get_class(new Field()));
        return $fieldMapper->load($id);
    }
    
    //Services definition: S0601
    function ListFieldsForm($idForm){
        $fieldsMapper = new ModelMapper(get_class(new Field()));
        return $fieldsMapper->loadBy("idForm", $idForm);
    }

    //Services definition: S0602
    function ListAttributesConceptMaterialized($idMC){
	$attributesMapper = new ModelMapper(get_class(new Attribute()));
	return $attributesMapper->loadBy("idConcept", $this->conceptMaterializedMapper->load($idMC)->idConcept);
    }

    //Services definition: S0603
    function CreateAlignment($idMC, $idField, $idAttribute){
	$alignmentMapper = new ModelMapper(get_class(new Alignment()));
	$temp = new Alignment();	
	$temp->idConceptMaterialized = $idMC;
	$temp->idField = $idField;
	$temp->idAttribute = $idAttribute;
	return $alignmentMapper->save($temp);
    }
    
    //Services definition: S0701
    function UpdateAlignment($idAligment, $idField, $idAttribute){
	$alignmentMapper = new ModelMapper(get_class(new Alignment()));
	$temp = $alignmentMapper->load($idAligment);
	$temp->idField = $idField;
	$temp->idAttribute = $idAttribute;
	return $alignmentMapper->save($temp);
    }
    
    //Services definition: S0702
    function RecoverAlignment($idAligment){
        $alignmentMapper = new ModelMapper(get_class(new Alignment()));
        return $alignmentMapper->load($idAligment);
    }

    //Services definition: S0801
    function DeleteAlignment($id){
	$alignmentsMapper = new ModelMapper(get_class(new Alignment()));
        $temp = $alignmentsMapper->load($id);
    	return $alignmentsMapper->delete($temp);
    }

    //Services definition: S0901
    function ListSchemas(){
	$schemasMapper = new ModelMapper(get_class(new Schema()));
	return $schemasMapper->loadAll();
    }

	//Services definition: S0901_1
    function ListSchemaById($id){
	$schemasMapper = new ModelMapper(get_class(new Schema()));
	return $schemasMapper->load($id);
    }

    //Services definition: S1001
    function ListConceptSchemas($idSchema){
	return $this->conceptMapper->loadBy('idSchema', $idSchema);
    }

    //Services definition: S1002
    function CreateSchema($name, $author){
	$schemasMapper = new ModelMapper(get_class(new Schema()));
	$temp = new Schema();	
	$temp->name = $name;
	$temp->author = $author;
        //TODO add date field 
	return $schemasMapper->save($temp);
    }
    
    //Services definition S1003
    function CreateConcept($idSchema, $conceptName){
        $temp = new Concept();
        $temp->idSchema = $idSchema;
        $temp->name = $conceptName;
        return $this->conceptMapper->save($temp);
    } 
    
    //Services definition S1004
    function CreateAttribute($idConcept, $attrName, $typeAttr){
        $attrMapper = new ModelMapper(get_class(new Attribute()));
        $temp = new Attribute();
        $temp->idConcept = $idConcept;
        $temp->name = $attrName;
        $temp->type = $typeAttr;
        return $attrMapper->save($temp);
    } 
    
    //Services definition: S1101
    function UpdateSchema($idSchema, $name, $author){
	$schemasMapper = new ModelMapper(get_class(new Schema()));
	$temp = new Schema();	
	$temp->id = $idSchema;
	$temp->name = $name;
	$temp->author = $author;
        //TODO add date field
	return $schemasMapper->save($temp);
    }
    
    //Services definition: S1102
    function UpdateConcept($idSchema, $conceptName){
        $temp = new Concept();
        $temp->idSchema = $idSchema;
        $temp->name = $conceptName;
        return $this->conceptMapper->save($temp);
    } 
    
    //Services definition: S1103
    function UpdateAttribute($idConcept, $attrName, $typeAttr){
        $attrMapper = new ModelMapper(get_class(new Attribute()));
        $temp = new Attribute();
        $temp->idConcept = $idConcept;
        $temp->name = $attrName;
        $temp->type = $typeAttr;
        return $attrMapper->save($temp);
    }
    
    //Services definition S1201
    function DeleteSchema($idSchema){
	$schemasMapper = new ModelMapper(get_class(new Schema()));
	$tempSchema = $schemasMapper->load($idSchema);
        return $schemasMapper->delete($tempSchema);
    }
    
    //Services definition S1301
    function ListAttributeConcept($idConcept){
        $attrMapper = new ModelMapper(get_class(new Attribute()));
        return $attrMapper->loadBy('idConcept', $idConcept);
    }
    
    //Services definition S1501
    function DeleteConcept($idConcept){
       $temp = $this->conceptMapper->load($idConcept);
    	return $this->conceptMapper->delete($temp);
    }
}

/*
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
/*
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
/*
//Testing CreateSchemaEmpty
$s->UpdateSchema(4,"new_schema_4", "andrei_02");
echo "<br/>Updated schema!";

//Testing DeleteSchema
/*$s->DeleteSchema(3);
echo "<br/>Deleted schema!";*/

?>
