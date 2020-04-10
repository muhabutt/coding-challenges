/**
 * Node class is like a object which contains two properties,
 * data , next
 * const n1 = new Node(100, 200)
 * { data: 100, next: 200 }
 *
 */
class Node {
	constructor(data, next = null) {
		this.data = data;
		this.next = next;
	}
}

/**
 * LinkedList is data structure, which holds it elements in following way
 * Head -> next -> tail
 * 100 and ref of next value, data and ref of next value, .... , the tail which is null
 */
class LinkedList {
	constructor() {
		this.head = null;
		this.size = 0;
	}

	//Insert The first Node
	insertFirst(data) {
		this.head = new Node(data, this.head);
		this.size++;
	}

	//Insert The last Node
	insertLast(data) {
		let node = new Node(data);
		let current;
		if (!this.head) {
			this.head = node;
		} else {
			current = this.head;
			while (current.next) {
				current = current.next;
			}
			current.next = node;
		}
		this.size++;
	}

	//Insert at Index
	insertIndex(data, index) {
		if (index > 0 && index > this.size) {
			return;
		}

		if (index === 0) {
			this.head = new Node(data, this.head)
			return;
		}

		const node = new Node(data);
		let current, previous;

		//set current to first
		current = this.head;
		let count = 0;
		while (count < index) {
			previous = current; //Node before the index
			count++;
			current = current.next; // Node after the index
		}

		node.next = current;
		previous.next = node;

		this.size++;
	}

	//Get at index
	getIndex(index) {
		let current = this.head;
		let count = 0;

		while (current) {
			if (count === index) {
				console.log(current.data);
			}
			count++;
			current = current.next;
		}
		return null;
	}

	// remove at index
	removeIndex(index) {
		if (index > 0 && index > this.size) {
			return;
		}

		let current = this.head;
		let previous;
		let count = 0;

		//Remove first
		if (index === 0) {
			this.head = current.next;
		} else {
			while (count < index) {
				count++;
				previous = current;
				current = current.next;
			}
			previous.next = current.next;
		}

		this.size--;
	}

	//clear list
	clearList() {
		this.head = null;
		this.size = 0;
	}

	//print list data
	printListData() {
		let current = this.head;
		while (current) {
			console.log(current.data);
			current = current.next;
		}
	}
}

/**
 * add LinkedList class to html
 * @param data
 * @param extras
 */
const addDataToHtml = (data, extras) => {
	let promiseOneByOneDiv = document.getElementById('linkList');
	if (extras) {
		promiseOneByOneDiv.innerHTML += extras;
	}
	promiseOneByOneDiv.innerHTML += `<pre>${JSON.stringify(data)}</pre>`;

}

const ll = new LinkedList();

ll.insertFirst(100);
ll.insertFirst(200);
ll.insertFirst(300);
ll.insertLast(400);

/*ll.insertIndex(500, 10);

ll.getIndex(12);

ll.removeIndex(1);

ll.printListData();
*/
addDataToHtml(ll);
