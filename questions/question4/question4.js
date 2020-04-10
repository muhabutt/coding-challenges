/**
 * function to get user
 */
const getUser = () => {
  return new Promise((resolve, reject) => {
    setTimeout(() => {
      //here we can call api to get user data
      const apicallResponse = {
        user: {
          user_id: 1,
          user_email: 'muha@gmail.com',
          user_name: 'Muhammad Kashif Zahid Butt',
          user_address: '14 Meadow road'
        }
      } // if apicallresponse is null than reject

      if (apicallResponse) {
        addPromiseResolve('function getUser is resolved')
        resolve(apicallResponse) //end resolve
      } else {
        addPromiseResolve('function getUser is rejected')
        reject('Sorry could not get user!')
      }
    }, 1000)
  })
}

/**
 * function to get posts
 */
const getPost = () => {
  return new Promise((resolve, reject) => {
    setTimeout(() => {
      //here we can call api to get post details by provided postId
      const apicallResponse = {
        post: {
          post_id: 1,
          title: 'Javascript Promise api',
          description: 'Promise is fun'
        }
      } // if apicallresponse is false than reject

      if (apicallResponse) {
        addPromiseResolve('function getPost is resolved')
        resolve(apicallResponse) //end resolve
      } else {
        addPromiseResolve('function getPost is rejected')
        reject('Sorry could not get post!')
      }
    }, 1000)
  })
}

/**
 * function to get orders
 */
const getOrder = () => {
  return new Promise((resolve, reject) => {
    setTimeout(() => {
      //here we can call api to get user orders by provided userId
      const apicallResponse = {
        order: {
          order_id: 1,
          product: 'Book'
        }
      } // if apicallresponse is false than reject

      if (apicallResponse) {
        addPromiseResolve('function getOrders is resolved')
        resolve(apicallResponse) //end resolve
      } else {
        addPromiseResolve('function getUserOrders is rejected')
        reject('Sorry could not get order!')
      }
    }, 1000)
  })
}

/**
 * Array of function's.
 */
const funcArray = [getUser, getPost, getOrder]

/**
 * Promise.all api runs all the promises, and if one promise is rejected
 * promise all will exit and return the error. Promise all can be usefull in situations
 * where one want's to run many promises and get the data from all of it, but
 * if one function get error than none will be resolved.
 *
 * Here we are using async and await for the all promises to be completed
 * and then get all the responses.
 * @param {*} funcArray
 */
async function promiseAll (funcArray) {
  await Promise.all([funcArray[1](), funcArray[0](), funcArray[2]()])
    .then(result => addPromiseResolve(result))
    .catch(error => addPromiseResolve(error))
}

/**
 * function is using array reduce , reduce will accumulate the initial and next
 * promise and promise.resolve callback will store the response.
 * @param {*} funcArray
 */
async function promiseOneByOne (funcArray) {
  await funcArray.reduce(async (accumulatorPromise, nextPromise) => {
    await accumulatorPromise
    const result = await nextPromise()
    addPromiseResolve(result,'<h1>Promise One By One</h1>')
  }, Promise.resolve())
}

const addPromiseResolve = (data,extras) => {
  let promiseOneByOneDiv = document.getElementById('promise');
  if(extras){
    promiseOneByOneDiv.innerHTML += extras;
  }
  promiseOneByOneDiv.innerHTML += `<pre>${JSON.stringify(data)}</pre>`;

}
promiseAll(funcArray)
promiseOneByOne(funcArray)
