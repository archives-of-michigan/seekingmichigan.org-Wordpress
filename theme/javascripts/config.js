function Test() { }

/* production
Test.prototype.config = { 
	host: 'haldigitalcollections.cdmhost.com',
	path: '/cdm4/get.php'
};
*/

/* development
Test.prototype.config = { 
	host: 'haldigitalcollections.cdmhost.com',
	path: '/cdm4/get.php',
	test_stubs: true
};
*/

/* test */
Test.prototype.config = { 
	host: 'localhost',
	path: '/get.php',
	test_stubs: true
};
/* noop */

environment = new Test();