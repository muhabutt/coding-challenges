function filterDuplicates(data) {
	// Write your code here
	// To debug: console.error('Debug messages...');
	return data.filter((v,i) => data.indexOf(v) === i)
}
