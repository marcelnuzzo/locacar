class Equipement {
	constructor(iddiv,parent,libelle,cpt) {
		this.parent=parent;
		//creation div
		this.div=document.createElement("div");
		this.div.id="iddiv"+cpt;
		parent.appendChild(this.div);
		//creation label
		this.label=document.createElement("label");
		this.label.htmlFor="label"+cpt;
		this.label.innerHTML= libelle + " " + cpt;
		this.div.appendChild(this.label);
		//creation select
		this.select=document.createElement("select");
		this.select.id="select"+cpt;
		this.select.name="select"+cpt;
		this.div.appendChild(this.select);
		//creation option
		for (let i=0;i<loc_option.length;i++) {
			let o=document.createElement("option");
			o.value=loc_option[i].opt_id;
			o.innerHTML=loc_option[i].opt_nom + " - " + loc_option[i].opt_prix + " €";
			this.select.appendChild(o);
		}
		//creation btSup
		this.btSup=document.createElement("button");
		this.btSup.type="button";
		this.btSup.addEventListener("click",()=>this.supprimer());
		this.btSup.innerHTML= "Supprimer" + " " + libelle + " " + cpt;
		this.div.appendChild(this.btSup);
	}
	
	supprimer() {
		this.parent.removeChild(this.div);
	}
}