<?php

	class Category {
		
		private 	$id,
						$id_parent, // peut-être nul si pas de categorie parente
						$label,
						$description,
						
						$badge; // Number of products in this category
				
		public function __construct(array $data){
			$this->hydrate($data);	
		}
		public function hydrate(array $data){
			foreach ($data as $key => $value){
				$method = 'set'.ucfirst($key);
				if (method_exists($this, $method)){
						$this->$method($value);
				}
			}
		}
		//setter
		public function id() { return $this->id;}
		public function id_parent() { return $this->id_parent;}
		public function label() { return $this->label;}
		public function description(){return $this->description;}
		public function badge(){return $this->badge;}
		//getter
		public function setId($id) { $this->id = (int) $id;}
		public function setId_parent($id_parent) { $this->id_parent = (int) $id_parent;}
		public function setLabel($label) { $this->label = $label;}
		public function setDescription($description) {$this->description = $description;}
		public function setBadge($badge) {$this->badge = $badge;}
		//ctrl
		
		public function ctrlCategory($tag=NULL){}
		
		
	}